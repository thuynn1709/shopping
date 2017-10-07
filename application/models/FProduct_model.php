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

    public function get_all_by_categoryId( $id) {
        $this->db->select('id, name, alias');
        $this->db->where('category_id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('amount', 'desc');
        return  $this->db->get( $this->table)->result();
    }
}
