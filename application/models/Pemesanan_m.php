<?php

class Pemesanan_m extends CI_Model{
    function get_all(){
        return $this->db->get('pemesanan');
    }
    function v_menunggu(){
        return $this->db->get('v_pesan_menunggu');
    }
    function v_pesanan_where($where){
        return $this->db->get_where('v_pemesanan', $where);
    }
    function v_proses(){
        return $this->db->get('v_pesan_proses');
    }
    function where($where){
        return $this->db->get_where('pemesanan', $where);
    }
    function hapus($where){
        $this->db->where($where);
        $this->db->delete('pemesanan');
    }
    function update($data, $where){
        $this->db->where($where);
		$this->db->update('pemesanan',$data);
    }
    function insert($post){
        return $this->db->insert('pemesanan', $post);
    }

    function max(){
        return $this->db->query('SELECT MAX(id) AS id FROM pemesanan');
    }
    function maxTrx($query){
        return $this->db->query($query);
    }
}