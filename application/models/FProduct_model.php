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
class FProduct_model extends CI_Model {
   
    public $table = 'products';
    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function get_all_by_categoryId( $id, $limit = null) {
        $this->db->select('id, name, alias, img, price, amount');
        $this->db->where('category_id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('amount', 'desc');
        if ($limit){
            $this->db->limit($limit);
        }
        return  $this->db->get( $this->table)->result();
    }
    
    public function get_all_by_Ids( $ids) {
        $this->db->select('id, name, alias, img_thumb, amount, price');
        $this->db->where_in('id', $ids);
        $this->db->where('status', 1);
        $this->db->order_by('created', 'desc');
        return  $this->db->get( $this->table)->result();
    }
    
    public function get_recommend_items() {
        $this->db->select('id, name, alias, img_1, amount, price');
        $this->db->where('status', 1);
        $this->db->order_by('amount', 'desc');
        $this->db->limit(9);
        return  $this->db->get( $this->table)->result_array();
    }
    
}
