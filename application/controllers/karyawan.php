<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
        $this->page->setTitle('Karyawan');
        $this->load->model('MKriteria');
        $this->load->model('MSubKriteria');
        $this->load->model('MKaryawan');
        $this->load->model('MNilai');
        $this->page->setLoadJs('assets/test/js/karyawan');
        
        if($this->session->userdata('level') <> 'admin'){
            redirect('login');
        }
    }



    public function index()
    {
        $data['karyawan'] = $this->MKaryawan->getAll();
        
        loadPage('karyawan/index', $data);
    }

    public function tambah($id = null)
    {

        if ($id == null) {
            if (count($_POST)) {
                $this->form_validation->set_rules('karyawan', '', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $errors = $this->form_validation->error_array();
                    $this->session->set_flashdata('errors', $errors);
                    redirect(current_url());
                } else {

                    $karyawan = $this->input->post('karyawan');
                    $nilai = $this->input->post('nilai');

                    $this->MKaryawan->karyawan = $karyawan;
                    if ($this->MKaryawan->insert() == true) {
                        $success = false;
                        $kdKaryawan = $this->MKaryawan->getLastID()->kdKaryawan;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdKaryawan = $kdKaryawan;
                            $this->MNilai->kdKriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MNilai->insert()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Berhasil menambah data :)');
                            redirect('karyawan');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
                //-----
            }else{
                $data['dataView'] = $this->getDataInsert();
                loadPage('karyawan/tambah', $data);
            }
        }else{
            if(count($_POST)){
                $kdKaryawan = $this->uri->segment(3, 0);
                dump($kdKaryawan);
                if($kdKaryawan > 0){
                    $karyawan = $this->input->post('karyawan');
                    $nilai = $this->input->post('nilai');
                    $where = array('kdKaryawan' => $kdKaryawan);
                    $this->MKaryawan->karyawan = $karyawan;
                    dump($karyawan);
                    if($this->MKaryawan->update($where) == true){
                        $success = false;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdKaryawan = $kdKaryawan;
                            $this->MNilai->kdKriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MNilai->update()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Berhasil mengubah data :)');
                            redirect('karyawan');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
            }
            $data['dataView'] = $this->getDataInsert();
            $data['nilaiKaryawan'] = $this->MNilai->getNilaiByKaryawan($id);
            loadPage('karyawan/tambah', $data);
        }

    }

    private function getDataInsert()
    {
        $dataView = array();
        $kriteria = $this->MKriteria->getAll();
        foreach ($kriteria as $item) {
            $this->MSubKriteria->kdKriteria = $item->kdKriteria;
            $dataView[$item->kdKriteria] = array(
                'nama' => $item->kriteria,
                'data' => $this->MSubKriteria->getById()
            );
        }

        return $dataView;
    }

    public function delete($id)
    {
        if($this->MNilai->delete($id) == true){
            if($this->MKaryawan->delete($id) == true){
                $this->session->set_flashdata('message','Berhasil menghapus data :)');
                echo json_encode(array("status" => 'true'));
            }
        }
    }
}