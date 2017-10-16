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
class Config extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        if (! $this->is_logged_in_admin()) {
            redirect(base_url('admin/login')); 
        }
        $this->load->model('admin/featuresitems_model');
        $this->load->model('admin/smallmenuitems_model');
        $this->load->model('admin/product_model');
        $this->load->model('admin/productcategory_model');
        $this->load->library('pagination');
    }
    
    public function featuresitems(){
        $this->_loadAdminHeader();
        $data = array();
        $limit = 20;
        $config = array();
        $config["base_url"] = base_url() . "admin/config/featuresitems";
        $total_row = $this->featuresitems_model->count_all_results();
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
        $data["results"] = $this->featuresitems_model->get_all( $config["per_page"], $offset);
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        $data['offset'] = $offset;
        $this->load->view('admin/config/features_items_index', $data);
        $this->_loadAdminFooter();
    }
    
    public function featuresitemsadd(){
        $this->_loadAdminHeader();
        $all_name_products = $this->product_model->get_name_all_products();
        
        $all_products_id = array();
        foreach ( $all_name_products as $al) {
            $all_products_id[] = $al['name'];
        }
        $data['all_name_products'] = json_encode($all_products_id);
        
        if (isset($_POST['count'])){
            $count = (int)$_POST['count'];
            $alias_array  = array();
            for( $i = 1; $i <= $count; $i++) {
                $field_id = 'field'.$i;
                $product_name = $_POST[$field_id];
                $alias = sanitizeTitle($product_name);
                $alias_array[] = $alias;
            }
            $alias_array = array_unique($alias_array);
            $products = array();
            $products = $this->product_model->get_product_by_alias($alias_array);
            $insert_array = array();
            foreach ( $products as $p) {
                $insert_array[] = array(
                    'product_id' => $p->id,
                    'product_name' => $p->name,
                    'created' => now()
                );
            }
            $this->featuresitems_model->insert( $insert_array, true);
            redirect('admin/config/featuresitems');  
        }
        
        $this->load->view('admin/config/features_items_add', $data);
        $this->_loadAdminFooter();
    }
    
    public function featuresitmesdelete()
    {
        $del_id = $this->uri->segment(4);
        $this->featuresitems_model->del_one($del_id);  
        redirect('admin/config/featuresitems');  
    }
    
    public function small_menu_items(){
        $this->_loadAdminHeader();
        $data = array();
        $limit = 20;
        $config = array();
        $config["base_url"] = base_url() . "admin/config/small_menu_items";
        $total_row = $this->smallmenuitems_model->count_all_results();
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
        $data["results"] = $this->smallmenuitems_model->get_all( $config["per_page"], $offset);
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        $data['offset'] = $offset;
        $this->load->view('admin/config/small_menu_items_index', $data);
        $this->_loadAdminFooter();
    }
    
    public function small_menu_items_add(){
        $this->_loadAdminHeader();
        $all_productcategory = $this->productcategory_model->get_all(50,0);
        
        $all_productcategory_id = array();
        foreach ( $all_productcategory as $al) {
            $all_productcategory_id[] = $al->name;
        }
        $data['all_name_products'] = json_encode($all_productcategory_id);
        
        if (isset($_POST['count'])){
            $count = (int)$_POST['count'];
            $alias_array  = array();
            for( $i = 1; $i <= $count; $i++) {
                $field_id = 'field'.$i;
                $productcategory_name = $_POST[$field_id];
                $alias = sanitizeTitle($productcategory_name);
                $alias_array[] = $alias;
            }
            
            
            $alias_array = array_unique($alias_array);
            $productcategories = array();
            $productcategories = $this->productcategory_model->get_productcategory_by_alias($alias_array);
            $insert_array = array();
            foreach ( $productcategories as $p) {
                $insert_array[] = array(
                    'category_id' => $p->id,
                    'category_name' => $p->name,
                    'created' => now()
                );
            }
            $this->smallmenuitems_model->insert( $insert_array, true);
            redirect('admin/config/small_menu_items');  
        }
        
        $this->load->view('admin/config/small_menu_items_add', $data);
        $this->_loadAdminFooter();
    }
    
    public function small_menu_items_delete()
    {
        $del_id = $this->uri->segment(4);
        $this->smallmenuitems_model->del_one($del_id);  
        redirect('admin/config/small_menu_items');  
    }
    
}
