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
class Product_model extends CI_Model {
   
    public $table = 'products';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all($search = '', $category_id = '', $limit = 10, $offset = 0) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('products_category', 'products_category.id = products.category_id');
        if ($search != '') {
            $this->db->like('name', $search);
        }
        if ($category_id !='') {
            $this->db->where('category_id', $category_id);
        }
        $this->order_by('products.created');
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
        $data =  $this->db->get( $this->table)->result();
        return !empty($data) ? $data[0] : array();
    }
    
    public function count_all_results($search = '', $category_id = '', $limit = 10, $offset = 0) {
        $this->db->from($this->table);
        $this->db->join('products_category', 'products_category.id = products.category_id');
        if ($search != '') {
            $this->db->like('name', $search);
        }
        if ($category_id !='') {
            $this->db->where('category_id', $category_id);
        }
        $this->db->limit($limit, $offset);
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
    
    
   


           
}
