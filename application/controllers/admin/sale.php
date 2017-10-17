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
    
    public function add(){
        $this->_loadAdminHeader();
        
        $all_name_products = $this->product_model->get_name_all_products();
        
        $all_products_id = array();
        foreach ( $all_name_products as $al) {
            $all_products_id[] = $al['name'];
        }
        $data['all_name_products'] = json_encode($all_products_id);
        
        if (isset($_POST['count'])){
            $count = (int)$_POST['count'];
            $insert_array  = array();
            for( $i = 1; $i <= $count; $i++) {
                $field_id = 'field'.$i;
                $qty_id = 'qty'.$i;
                $price_id = 'price'.$i;
                $product_name = $_POST[$field_id];
                $price = ($_POST[$price_id]);
                $amount = (int)$_POST[$qty_id];
                $alias = sanitizeTitle($product_name);
                $insert_array[] = array(
                    'product_name' => $product_name ,
                    'product_alias' => sanitizeTitle($product_name) , 
                    'price' => $price,
                    'amount' => $amount,
                    'status' => 0,
                    'created' => now()
                );
            }
                
            $structured_results = array();
            foreach($insert_array as $key => $value)
            {
                if( !isset($structured_results[$value['product_alias']])) {
                    $structured_results[$value['product_alias']] = array( 
                        'import_id' => $import_id,
                        'product_name' => $value['product_name'] ,
                        'product_alias' => $value['product_alias'], 
                        'price' => $price,
                        'amount' => $value['amount'],
                        'status' => 0,
                        'created' =>  now(),
                        'updated' =>  now()
                    );
                } else {
                    $structured_results[$value['product_alias']] = array(
                        'import_id' => $import_id,
                        'product_name' => $value['product_name'] ,
                        'product_alias' => $value['product_alias'], 
                        'price' => $price,
                        'amount' => $value['amount'] + $structured_results[$value['product_alias']]['amount'],
                        'status' => 0,
                        'created' =>  now(),
                        'updated' =>  now()
                    );
                }
            }

            if (!empty($structured_results)) {
                //$this->importdetail_model->insert($structured_results, true);
            }
            redirect('admin/import_detail/index/');
        }
        
        $this->load->view('admin/sale/add', $data);
        $this->_loadAdminFooter();
    }
    
}
