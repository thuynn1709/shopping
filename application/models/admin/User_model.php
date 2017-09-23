<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Productcategory_model
 *
 * @author Nguyen Ruy
 */
class User_model extends CI_Model {
   
    public $table = 'users';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all($search = '', $group_id = '', $limit = 10, $offset = 0) {
        $this->db->select('*');
        $this->db->from($this->table);
       
        if ($search != '') {
            $this->db->like('name', $search);
        }
        if ($group_id !='') {
            $this->db->where('group', $group_id);
        }
        $this->db->order_by('created');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    
    public function get_name_all_products() {
        $this->db->select('name');
        $this->db->from($this->table);
        return $this->db->get()->result_array();
    }

    public function get_one( $id) {
        $this->db->where('id', $id);
        return $this->db->get( $this->table)->row();
    }
    
    public function count_all_results($search = '', $group_id = '') {
        $this->db->from($this->table);
       
        if ($search != '') {
            $this->db->like('name', $search);
        }
        if ($group_id !='') {
            $this->db->where('group', $group_id);
        }
        return $this->db->count_all_results();
 
    }
    
    public function del_one ($id){
        return $this->db->delete( $this->table, array('id' => $id));  
    }
    
    public function del_all(){
        return $this->db->empty_table( $this->table); 
    }

    public function update($id , $data = array()){
        $this->db->where('id', $id);
        return $this->db->update( $this->table, $data);
    }

    public function insert ($data, $insert_batch = false){
        if ( $insert_batch) {
            $this->db->insert_batch( $this->table, $data);
            return true;
        }
        $this->db->insert( $this->table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function check_user($user_info)
    {
        $array = array('email' => $user_info['email'], 'password' => $user_info['password']);
        $this->db->where($array);
        return $this->db->get( $this->table)->row();
    }        
   


           
}
