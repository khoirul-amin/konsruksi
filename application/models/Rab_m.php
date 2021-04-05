<?php

class Rab_m extends CI_Model{
    function get_all(){
        return $this->db->get('detail_konstruksi');
    }
    function where($where){
        return $this->db->get_where('detail_konstruksi', $where);
    }
    function hapus($where){
        $this->db->where($where);
        $this->db->delete('detail_konstruksi');
    }
    function update($data, $where){
        $this->db->where($where);
		$this->db->update('detail_konstruksi',$data);
    }
    function insert($post){
        return $this->db->insert('detail_konstruksi', $post);
    }
    function sum($where){
        $this->db->where($where);
        $this->db->select_sum('total');
        return $this->db->get('detail_konstruksi');
    }
}