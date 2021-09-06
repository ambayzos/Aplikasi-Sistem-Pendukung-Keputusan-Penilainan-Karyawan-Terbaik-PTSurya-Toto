<?php


class MNilai extends CI_Model{

    public $kdKaryawan;
    public $kdKriteria;
    public $nilai;

    public function __construct(){
        parent::__construct();
    }

    private function getTable()
    {
        return 'nilai';
    }

    private function getData()
    {
        $data = array(
            'kdKaryawan' => $this->kdKaryawan,
            'kdKriteria' => $this->kdKriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert($this->getTable(), $this->getData());
        return $status;
    }

    public function getNilaiByKaryawan($id)
    {
        $query = $this->db->query(
            'select u.kdKaryawan, u.karyawan, k.kdKriteria, n.nilai from karyawan u, nilai n, kriteria k, subkriteria sk where u.kdKaryawan = n.kdKaryawan AND k.kdKriteria = n.kdKriteria and k.kdKriteria = sk.kdKriteria and u.kdKaryawan = '.$id.' GROUP by n.nilai '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaiKaryawan()
    {
        $query = $this->db->query(
            'select u.kdKaryawan, u.karyawan, k.kdKriteria, k.kriteria ,n.nilai from karyawan u, nilai n, kriteria k where u.kdKaryawan = n.kdKaryawan AND k.kdKriteria = n.kdKriteria '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('kdKaryawan', $this->kdKaryawan);
        $this->db->where('kdKriteria', $this->kdKriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kdKaryawan', $id);
        return $this->db->delete($this->getTable());
    }
}