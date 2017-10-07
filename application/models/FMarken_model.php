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
class FMarken_model extends CI_Model {
   
    public $table = 'marken';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_product_in_marken( $limit = 20, $offset = 0) {
        $this->db->select('m.*, count(p.marken_id) as total');
        $this->db->from($this->table. ' as m');
        $this->db->join('products as p', 'p.marken_id = m.id');
        //$this->db->where('p.status', 1);
        $this->db->group_by('p.marken_id'); 
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    
   
    
   


           
}
