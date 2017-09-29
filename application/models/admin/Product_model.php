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
    
    public function get_all($search = '', $category_id = '', $marken_id = '', $limit = 10, $offset = 0) {
        $this->db->select('p.*, pc.id as pcid, pc.name as pcname, pc.created as pccreated');
        $this->db->from($this->table. ' as p');
        $this->db->join('products_category as pc', 'p.category_id = pc.id', 'left');
        if ($search != '') {
            $this->db->like('p.name', $search);
        }
        if ($category_id !='') {
            $this->db->where('p.category_id', $category_id);
        }
        
        if ($marken_id !='') {
            $this->db->where('p.marken_id', $marken_id);
        }
        
        $this->db->order_by('p.updated', 'desc');
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
    
    public function check_one_by_alias($alias) {
        $this->db->where('alias', $alias);
        $data =  $this->db->get( $this->table)->row();
        if (!empty($data)) 
            return true;
        
        return FALSE;    
    }

    public function count_all_results($search = '', $category_id = '', $marken_id = '') {
        $this->db->select('p.*, pc.id as pcid, pc.name as pcname');
        $this->db->from($this->table. ' as p');
        $this->db->join('products_category as pc', 'p.category_id = pc.id', 'left');
        if ($search != '') {
            $this->db->like('p.pname', $search);
        }
        if ($category_id !='') {
            $this->db->where('p.pcid', $category_id);
        }
        
        if ($marken_id !='') {
            $this->db->where('p.marken_id', $marken_id);
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
    
    public function update_batch( $data, $field){
        $this->db->update_batch( $this->table, $data, $field);
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
    
    public function get_product_by_alias ( $alias = array()){
        $this->db->select('id');
        $this->db->where_in('alias', $alias);
        //$this->db->where('status', 1);
      
        $this->db->from($this->table);
        return $this->db->get()->result();
    }
    
    public function count_alls_features_items ( $ids = array()){
        $this->db->select('name, status, id');
        $this->db->where_in('id', $ids);
        //$this->db->where('status', 1);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    public function get_ids_by_categoryId ( $category_id){
        $this->db->select( 'id, category_id');
        $this->db->where('category_id', $category_id);
        $this->db->from($this->table);
        return $this->db->result();
    }
    
    public function get_ids_by_ ( $category_id){
        $this->db->select( 'id, category_id');
        $this->db->where('category_id', $category_id);
        $this->db->from($this->table);
        return $this->db->result();
    }
   


           
}
