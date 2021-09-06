<?php

class MKaryawan extends CI_Model{

    public $kdKaryawan;
    public $karyawan;

    public function __construct(){
        parent::__construct();
    }

    private function getTable(){
        return 'karyawan';
    }

    private function getData(){
        $data = array(
            'karyawan' => $this->karyawan
        );

        return $data;
    }

    public function getAll()
    {
        $karyawan = array();
        $query = $this->db->get($this->getTable());
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $karyawan[] = $row;
            }
        }
        return $karyawan;
    }


    public function insert()
    {
        $this->db->insert($this->getTable(), $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $status = $this->db->update($this->getTable(), $this->getData(), $where);
        return $status;

    }

    public function delete($id)
    {
        $this->db->where('kdKaryawan', $id);
        return $this->db->delete($this->getTable());
    }

    public function getLastID(){
        $this->db->select('kdKaryawan');
        $this->db->order_by('kdKaryawan', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->getTable());
        return $query->row();
    }


}