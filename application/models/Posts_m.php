<?php

class Posts_m extends CI_Model{
    function get_all(){
        return $this->db->get('posts');
    }
    function where($where){
        return $this->db->get_where('posts', $where);
    }
    function hapus($where){
        $this->db->where($where);
        $this->db->delete('posts');
    }
    function update($data, $where){
        $this->db->where($where);
		$this->db->update('posts',$data);
    }
    function insert($post){
        return $this->db->insert('posts', $post);
    }
}