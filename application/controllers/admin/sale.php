<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Index
 *
 * @author Nguyen Ruy
 */

class Sale extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        if (! $this->is_logged_in_admin()) {
            redirect(base_url('admin/login/login')); 
        }
        $this->load->model('admin/productcategory_model');
        $this->load->model('admin/product_model');
        $this->load->model('admin/menu_model');
        $this->load->model('admin/marken_model');
        $this->load->model('admin/user_model');
        $this->load->model('admin/sale_model');
        $this->load->library('pagination');
    }
    
    public function index() {
        $this->_loadAdminHeader();
        $user_name = '';
        $product_name = '';
        $category_id = '';
        $marken_id = '';
        if ($_POST) {
            $user_name = $_POST['name'];
            $category_id = $_POST['category_id'] ;
            $marken_id = $_POST['marken_id'] ;
            $product_name = $_POST['product_name'] ;
            
        }
        $data = array();
        $limit = 20;
        $config = array();
        $config["base_url"] = base_url() . "admin/sale/index";
        $total_row = $this->sale_model->count_all_results( $user_name, $marken_id, $category_id );
        $config["total_rows"] = $total_row;
        $config["per_page"] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $offset = 0;
        $offset = $this->uri->segment(4) > 0 ? (($this->uri->segment(4) + 0) * $config['per_page'] - $config['per_page']) : $this->uri->segment(4) ;
        
        $data["results"] = $this->sale_model->get_all( $user_name, $marken_id, $category_id, $config["per_page"], $offset);
        $data["links"] = $this->pagination->create_links();

        $data['offset'] = $offset;
        $data['users'] = $this->user_model->get_all_name();
        $data["marken"] = $this->marken_model->get_all( 100, 0);
        $data["category"] = $this->productcategory_model->get_all( 100, 0);
        $data['product_name'] = $product_name;
        $data['user_name'] = $user_name;
        
        $this->load->view('admin/sale/index', $data);
        $this->_loadAdminFooter();
    }
    
}
