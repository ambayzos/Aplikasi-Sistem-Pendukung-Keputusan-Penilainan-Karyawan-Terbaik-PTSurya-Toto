<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rangking extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MKriteria');
        $this->load->model('MNilai');
        $this->load->model('MKaryawan');
        $this->load->model('MSAW');
        $this->page->setTitle('Rangking');
        $this->page->setLoadJs('assets/test/js/tabel');
        

    }

    public function index()
    {
        $karyawan = $this->MKaryawan->getAll();

        if($karyawan == null){
            redirect('rangking/noData');
        }
        /**
         * Menghapus table SAW jika ada
         */
        $this->MSAW->dropTable();

        /**
         * $kriteria data dari table kriteria
         */
        $kriteria = $this->MKriteria->getAll();

        /**
         * membuat table SAW berdasarkan data dari table kriteria
         * menginputkan semua data nilai
         */
        $this->MSAW->createTable($kriteria);

        /**
         * Ambil data dari table SAW untuk perhitungan awal
         */
        $table1 = $this->initialTableSAW($karyawan);
        $this->page->setData('table1', $table1);


        /**
         * mengambil sifat kriteria
         * @var $dataSifat array
         */
        $dataSifat = $this->getDataSifat();
        $this->page->setData('dataSifat', $dataSifat);

        /**
         * Mengambil nilai maksimal dan minimal berdasarkan sifat
         */
        $dataValueMinMax = $this->getVlueMinMax($dataSifat);
        $this->page->setData('valueMinMax', $dataValueMinMax);

        /**
         * Proses 1 ubah data berdasarkan sifat
         */

        $table2 = $this->getCountBySifat($dataSifat,$dataValueMinMax);
        $this->page->setData('table2', $table2);

        /**
         * Hitung perkalian bobot dengan nilai kriteria
         */
        $bobot = $this->MKriteria->getBobotKriteria();
        $this->page->setData('bobot', $bobot);
        $table3 = $this->getCountByBobot($bobot);
        $this->page->setData('table3', $table3);

        /**
         * Add kolom total dan rangking
         */
        $this->MSAW->addColumnTotalRangking();

        /**
         * Menghitung nilai total
         */
        $this->countTotal();

        /**
         * Mengambil data yang sudah di rangking
         */
        $tableFinal = $this->getDataRangking();
        $this->page->setData('tableFinal', $tableFinal);

        

        
        /**
         * Menghapus table SAW
         */
        $this->MSAW->dropTable();
        if ($this->session->userdata('level') == ('admin')) {
           loadPage('saw/index');
       }elseif ($this->session->userdata('level') == ('user')) {
        loadPageUser('saw/index');
    }

    //loadPage('saw/index');
}

public function noData()
{
    loadPage('saw/noData');
}
private function initialTableSAW($karyawan)
{
    $nilai = $this->MNilai->getNilaiKaryawan();

    $dataInput = array();
    $no = 0;
    foreach ($karyawan as $item => $itemKaryawan) {
        foreach ($nilai as $index => $itemNilai) {
            if ($itemKaryawan->kdKaryawan == $itemNilai->kdKaryawan) {
                $dataInput[$no]['karyawan'] = $itemKaryawan->karyawan;
                $dataInput[$no][$itemNilai->kriteria] = $itemNilai->nilai;
            }
        }
        $no++;
    }

    foreach ($dataInput as $data => $item){
        $this->MSAW->insert($item);
    }
    return $this->MSAW->getAll();
}

private function getDataSifat()
{
    $sawData = $this->MSAW->getAll();
    $dataSifat = array();
    foreach ($sawData as $item => $value) {
        foreach ($value as $x => $z) {
            if ($x == 'Karyawan') {
                continue;
            }
            $dataSifat[$x] = $this->MSAW->getStatus($x);
        }
    }
    return $dataSifat;
}

private function getVlueMinMax($dataSifat)
{
    $sawData = $this->MSAW->getAll();
    $dataValueMinMax = array();
    foreach ($sawData as $point => $value) {
        foreach ($value as $x => $z) {
            if ($x == 'Karyawan') {
                continue;
            }
            foreach ($dataSifat as $item => $itemX) {
                if ($x == $item) {

                    if ($x == $item && $itemX->sifat == 'B') {
                        if (!isset($dataValueMinMax['max' . $x])) {
                            $dataValueMinMax['kriteria'.$x] = $x;
                            $dataValueMinMax['max' . $x] = $z;
                            $dataValueMinMax['sifat' . $x] = 'Benefit';
                        } elseif ($z > $dataValueMinMax['max' . $x]) {
                            $dataValueMinMax['max' . $x] = $z;
                        }
                    } else {
                        if (!isset($dataValueMinMax['min' . $x])) {
                            $dataValueMinMax['kriteria'.$x] = $x;
                            $dataValueMinMax['min' . $x] = $z;
                            $dataValueMinMax['sifat' . $x] = 'Cost';
                        } elseif ($z < $dataValueMinMax['min' . $x]) {
                            $dataValueMinMax['min' . $x] = $z;
                        }
                    }
                }
            }
        }
    }

    return $dataValueMinMax;
}

private function getCountBySifat($dataSifat, $dataValueMinMax)
{
    $sawData = $this->MSAW->getAll();
    foreach ($sawData as $point => $value) {
        foreach ($value as $x => $z) {
            if ($x == 'Karyawan') {
                continue;
            }
            foreach ($dataSifat as $item => $sifat) {
                if ($x == $item) {
                    if($sifat->sifat == 'B'){

                        $newData = $z / $dataValueMinMax['max'.$x];
                        $dataUpdate = array(
                            $x => $newData
                        );
                        $where = array(

                            'Karyawan' => $value->Karyawan
                        );

                        $this->MSAW->update($dataUpdate, $where);
                    }else{
                        $newData = $dataValueMinMax['min'.$x] / $z ;
                        $dataUpdate = array(
                            $x => $newData
                        );
                        $where = array(

                            'Karyawan' => $value->Karyawan
                        );

                        $this->MSAW->update($dataUpdate, $where);
                    }
                }
            }
        }
    }

    return $this->MSAW->getAll();
}

private function countTotal()
{
    $sawData = $this->MSAW->getAll();

    foreach ($sawData as $item => $value) {
        $total = 0;
        foreach ($value as $item => $itemData) {
            if($item == 'Karyawan'){
                continue;
            }elseif($item == 'Total'){
                $dataUpdate = array(
                    'Total'=> $total
                );

                $where = array(
                    'Karyawan' => $value->Karyawan
                );

                $this->MSAW->update($dataUpdate, $where);
            }else{
                $total = $total + $itemData;
            }
        }
    }
}

private function getCountByBobot($bobot)
{

    $sawData = $this->MSAW->getAll();
    foreach ($sawData as $point => $value) {
        foreach ($value as $x => $z) {
            if ($x == 'Karyawan') {
                continue;
            }
            foreach ($bobot as $item => $itemKriteria) {

                if ($x == $itemKriteria->kriteria) {

                    $sawData[$point]->$x =  $z * $itemKriteria->bobot ;
                    $newData = $z * $itemKriteria->bobot;
                    $dataUpdate = array(
                        $x => $newData
                    );
                    $where = array(
                        'Karyawan' => $value->Karyawan
                    );

                    $this->MSAW->update($dataUpdate, $where);

                }
            }
        }
    }

    return $this->MSAW->getAll();
}

private function getDataRangking()
{
    $sawData = $this->MSAW->getSortTotalByDesc();
    $no = 1;
    foreach ($sawData as $item => $value) {
        $dataUpdate = array(
            'Rangking' => $no
        );
        $where = array(
            'Karyawan' => $value->Karyawan
        );

        $this->MSAW->update($dataUpdate, $where);
        $no++;
    }
    return $this->MSAW->getAll();
}




}