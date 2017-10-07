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
class FProductcategory_model extends CI_Model {
   
    public $table = 'products_category';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_product_in_category( $limit = 20, $offset = 0) {
        $this->db->select('pc.*, count(p.category_id) as total');
        $this->db->from($this->table. ' as pc');
        $this->db->join('products as p', 'p.category_id = pc.id');
        $this->db->where('p.status', 1);
        $this->db->group_by('p.category_id'); 
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    
    public function get_all_category() {
        $this->db->select('id, name, alias');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

        public function get_one( $id) {
        $this->db->where('id', $id);
        return   $this->db->get( $this->table)->row();
    }
    
    public function count_all_results() {
        $this->db->from( $this->table);
        return $this->db->count_all_results();
    }
    
}
