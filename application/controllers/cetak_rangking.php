<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cetak_rangking extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('MKriteria');
    $this->load->model('MNilai');
    $this->load->model('MKaryawan');
    $this->load->model('MSAW');
    $this->page->setTitle('cetak');
    
    

  }

  public function index()
  {     
    
    $karyawan = $this->MKaryawan->getAll();
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
        $this->cetakpdf_rangking();
        
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


      private function cetakpdf_rangking(){
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $html='<!DOCTYPE html>
        <html>
        <head>
        <title>Cetak Dokumen Penilaian Karyawan Teraik</title>
        </head>
        <body>
        <h3 align="center"> Penilaian Karyawan Terbaik </h3>
        <h4 align="center">PT SURYA TOTO Indonesia Tbk</h4>
        
        <h5 align="left"> </h5>
        <table border="1" cellpadding="10" cellspacing="">
        <tr>
        <th>No</th>';
        $no = 1;
        $table = $this->page->getData('tableFinal');;
        foreach ($table as $item => $value) {
          foreach ($value as $heading => $itemValue) {
            $html .='<th>'.$heading.'</th>';
          }
          break;
        }
        $html .='</tr>';
        foreach ($table as $item => $value) {
         $html .='<tr>
         <td align="center">'.$no.'</td>';
         foreach ($value as $itemValue) {
           $html .='<td align="center">'.$itemValue.'</td>';
         }
         $html .='</tr>';
         $no++;
       }
       $html .='
       </table>';
       $table = $this->page->getData('tableFinal');
       foreach ($table as $item => $value) {
        if ($value->Rangking == 1) {
          $html .='<h5>Kesimpulan : Dari hasil perhitungan yang dilakukan menggunakan metode SAW
          Penilaian Karyawan Terbaik  adalah '.$value->Karyawan.' dengan Nilai '.$value->Total.'</h5>';
        }
      }

      $html.='
      </body>
      </html>';
      $mpdf->WriteHTML($html);
      $mpdf->Output();
    }




  }
