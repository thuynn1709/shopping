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
class FMenu_model extends CI_Model {
   
    public $table = 'menu';
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all($limit = 10, $offset = 0) {
        $this->db->where('status', 1);
        $this->db->order_by("priority", "asc");
        return  $this->db->get( $this->table, $limit, $offset)->result();
    }
    
    
    
    public function count_all_results() {
        $this->db->from( $this->table);
        return $this->db->count_all_results();
    }
      
}
