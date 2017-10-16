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
class Slidebar_model extends CI_Model {
   
    public $table = 'slidebar';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all($limit = 10, $offset = 0) {
        $this->db->order_by("created", "desc");
        return  $this->db->get( $this->table, $limit, $offset)->result();
    }
    
    public function get_one( $id) {
        $this->db->where('id', $id);
        return  $this->db->get( $this->table)->row();
    }
    
    public function count_all_results() {
        $this->db->from( $this->table);
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
        return true;
    }
    
    
   


           
}
