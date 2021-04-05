<?php

class User_m extends CI_Model{
    function cek_data_user($key,$value){
        $where = array(
            $key => $value
        );
        return $this->db->get_where('users', $where);
    }

    function register($post){
        return $this->db->insert('users', $post);
    }
    function login($where){
        return $this->db->get_where('users', $where);
    }
    function login_success($data, $where){
        $this->db->where($where);
		$this->db->update('users',$data);
    }
    function total_pelanggan(){
        return $this->db->query('SELECT COUNT(id) AS id FROM users WHERE role = 3');
    }
    function hapus($where){
        $this->db->where($where);
        $this->db->delete('users');
        // $this->db->delete('users', $where);
    }
}