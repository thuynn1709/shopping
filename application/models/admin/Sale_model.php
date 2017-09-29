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
class Sale_model extends CI_Model {
   
    public $table = 'sales';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all($user_id = '', $product_id = '', $limit = 10, $offset = 0) {
        $this->db->select('s.*, u.id, u.fullname, p.id, p.name');
        $this->db->from($this->table. ' as s');
        $this->db->join('users as u', 's.user_id = u.id', 'left');
        $this->db->join('products as p', 's.product_id = p.id', 'left');
        
        if ($product_id !='') {
            $this->db->where('p.product_id', $product_id);
        }
        
        if ($user_id !='') {
            $this->db->where('u.user_id', $user_id);
        }
        
        $this->db->order_by('s.created', 'desc');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    
    public function get_all_by_orderDetailId( $ids) {
        $this->db->where_in("order_detail_id", $ids);
        return  $this->db->get( $this->table)->result();
    }
    
    public function get_one( $id) {
        $this->db->where('id', $id);
        return  $this->db->get( $this->table)->row();
    }
    
    public function count_all_results( $user_id = '', $product_id = '') {
        $this->db->select('s.*, u.id, u.fullname, p.id, p.name');
        $this->db->from($this->table. ' as s');
        $this->db->join('users as u', 's.user_id = u.id', 'left');
        $this->db->join('products as p', 's.product_id = p.id', 'left');
        
        if ($product_id !='') {
            $this->db->where('p.product_id', $product_id);
        }
        
        if ($user_id !='') {
            $this->db->where('u.user_id', $user_id);
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
        return true;
    }
    
    public function delete_by_orderDetailId($ids)
    {
        $this->db->where_in('order_detail_id', $ids);
        $this->db->delete( $this->table);
        return true;
    }
    
    
   


           
}
