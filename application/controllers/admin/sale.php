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
        
        // suggest product
        $all_name_products = $this->product_model->get_name_all_products();
        $all_products_id = array();
        foreach ( $all_name_products as $al) {
            $push = array('label' => $al['name'], 'value' => $al['name'], 'id' => $al['id']);
            array_push($all_products_id, $push);
        }
        $data['all_name_products'] = json_encode($all_products_id);
        
        // suggest user
        $all_name_users = $this->user_model->get_name_all_user();
        $all_users = array();
        foreach ( $all_name_users as $al) {
            $push = array('label' => $al['fullname'], 'value' => $al['fullname'], 'id' => $al['id']);
            array_push($all_users, $push);
        }
        $data['all_users'] = json_encode($all_users);
        
        if (isset($_POST['count'])){
            $count = (int)$_POST['count'];
            $insert_user  = array();
            
            $user_id = $_POST['user_id'];
           
            if (empty($user_id)) {
                $insert_user = array (
                    'fullname' => $_POST['name'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'address' => $_POST['address'],
                    'address_ship' =>  $_POST['address_ship'],
                );
                $user_id = $this->user_model->insert($insert_user);
            }         
            $insert_array = array();
            for( $i = 1; $i <= $count; $i++) {
                $field_id = 'field'.$i;
                if ( isset($field_id) && $_POST[$field_id] != '' ) {
                    $field_id = 'field'.$i;
                    $qty_id = 'qty'.$i;
                    $discount_id = 'price'.$i;
                    $pid = 'pid'. $i;
                    $product_name = $_POST[$field_id];
                    $product_id = $_POST[$pid];
                    $discount = (int)($_POST[$discount_id]);
                    $amount = (int)$_POST[$qty_id];
                    $alias = sanitizeTitle($product_name);
                    $product_detail = $this->product_model->get_one_product_by_alias($alias);
                   
                    if ($product_detail) {
                        $insert_array[] = array(
                            'product_id' => $product_detail->id ,
                            'user_id' => $user_id, 
                            'order_detail_id' => 0, 
                            'amount' => $amount,
                            'price' => (int)$product_detail->price - (int)$product_detail->discount,
                            'discount' => $discount,
                            'pricetotal' =>  ((int)$product_detail->price - (int)$product_detail->discount ) * (int)$amount - (int)$discount,
                            'type' => 1,
                            'created' => now()
                        );
                    }
                }
            }
            
            $structured_results = array();
            foreach($insert_array as $key => $value)
            {
                if( !isset($structured_results[$value['product_id']])) {
                    $structured_results[$value['product_id']] = array( 
                        'product_id' => $value['product_id'] ,
                        'user_id' => $value['user_id'], 
                        'order_detail_id' => $value['order_detail_id'], 
                        'amount' => $value['amount'],
                        'price' => $value['price'],
                        'discount' => $value['discount'],
                        'pricetotal' =>  $value['pricetotal'],
                        'type' => 1,
                        'created' => now()
                    );
                } else {
                    $structured_results[$value['product_id']] = array(
                        'product_id' => $value['product_id'] ,
                        'user_id' => $value['user_id'], 
                        'order_detail_id' => $value['order_detail_id'], 
                        'amount' => $value['amount'] + $structured_results[$value['product_id']]['amount'],
                        'price' => $value['price'],
                        'discount' => $value['discount'] + $structured_results[$value['product_id']]['discount'],
                        'pricetotal' =>  $value['pricetotal'] + $structured_results[$value['product_id']]['pricetotal'],
                        'type' => 1,
                        'created' => now()
                    );
                }
            }
            
            if (!empty($structured_results)) {
                $this->sale_model->insert($structured_results, true);
            }
            redirect('admin/sale/index/');
        }
        
        $this->load->view('admin/sale/add', $data);
        $this->_loadAdminFooter();
    }
    
    public function get_info_user_byId() {
        if ($_POST) {
            $user_id = $_POST['user_id'];
            $user = $this->user_model->get_one($user_id);
            if ($user) {
                $array = array ('msg' => 'success', 'data' => $user);
                echo json_encode($array);die;
            }
            $array = array ('msg' => 'error');
            echo json_encode($array);die;
        }
        $array = array ('msg' => 'error');
        echo json_encode($array);die;
    }
}
