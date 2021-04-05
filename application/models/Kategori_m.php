<?php

class Kategori_m extends CI_Model{
    function get_all(){
        return $this->db->get('kategori');
    }
    function where($where){
        return $this->db->get_where('kategori', $where);
    }
    function hapus($where){
        $this->db->where($where);
        $this->db->delete('kategori');
    }
    function update($data, $where){
        $this->db->where($where);
		$this->db->update('kategori',$data);
    }
    function insert($post){
        return $this->db->insert('kategori', $post);
    }
}