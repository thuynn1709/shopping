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
class Importdetail_model extends CI_Model {
   
    public $table = 'import_detail';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all($import_id, $limit = 10, $offset = 0) {
        $this->db->where('import_id', $import_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit( $limit, $offset);
        $results =  $this->db->get( $this->table)->result();
        
        return $results;
    }
    
    public function get_all_by_importId($import_id) {
        $this->db->where('import_id', $import_id);
        return  $this->db->get($this->table)->result();
    }
    
    public function get_one( $id) {
        $this->db->where('id', $id);
        $data =  $this->db->get( $this->table)->result();
        return !empty($data) ? $data[0] : array();
    }
    
    public function count_all_results($import_id) {
        $this->db->from( $this->table);
        $this->db->where('import_id', $import_id);
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
    
    public function update_status_imported_to_product($data = array()){
        $this->db->where_in('product_alias', $data);
        return $this->db->update( $this->table, array( 'status' => 1)); 
    }
    
    public function update_status_one( $id){
        $this->db->where('id', $id);
        return $this->db->update( $this->table, array( 'status' => 1)); 
    }
   


           
}
