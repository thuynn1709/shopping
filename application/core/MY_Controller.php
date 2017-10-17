<?php

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper('cookie');
        $this->load->model('fproductcategory_model');
        $this->load->model('fproduct_model');
        $this->load->model('fmarken_model');
        $this->load->model('fmenu_model');
    }
    
    public function _loadFrontendHeader(){
        $this->load->view('frontend/header');
    }
    
    public function _loadFrontendHeaderAccount(){
        $menus = array();
        $menus = $this->fmenu_model->get_all();
        $list_menus = array();
        foreach ( $menus as $m) {
            $list_menus[$m->alias]['name'] = $m->name;
            $list_menus[$m->alias]['alias'] = $m->alias;
            $list_menus[$m->alias]['details'] = $this->fproductcategory_model->get_all_category_by_menuId($m->id);
        }
        
        $data = array();
        $data['list_menus'] = $list_menus;
        $this->load->view('frontend/header_account', $data);
    }
    
    public function _loadFrontendSlider(){
        $this->load->view('frontend/slider');
    }
    
    public function _loadFrontendLeftSlidebar(){
        
        $categories = $this->fproductcategory_model->get_all_category();
        $product_in_category = array();
        foreach ( $categories as $ct) {
            $product_in_category[$ct->id]['name'] = $ct->name;
            $product_in_category[$ct->id]['alias'] = $ct->alias;
            $product_in_category[$ct->id]['details'] = $this->fproduct_model->get_all_by_categoryId($ct->id);
        }
        $all_product = $this->fmarken_model->get_all_product_in_marken();
        $data['markens'] = $all_product;
        $data['product_in_category'] = $product_in_category;
        
        $this->load->view('frontend/left-slidebar', $data);
    }

    public function _loadFrontendFooter(){
        $this->load->view('frontend/footer');
    }
    
    public function _loadFrontendContent(){
        $this->load->view('frontend/content');
    }
    
    public function _loadAdminHeader(){
        $this->load->view('admin/admin_header');
        $this->load->view('admin/admin_left_side_column');
        $this->load->view('admin/admin_js');
    }
    
    public function _loadAdminFooter(){
        $this->load->view('admin/admin_footer');
        $this->load->view('admin/admin_control_sidebar');
       
    }
    public function _loadAdminContent(){
        $this->load->view('admin/admin_content');
    }
    
    public function is_logged_in()
    {
        $user = $this->session->userdata('email');
        return isset($user);
    }
    
    public function is_logged_in_admin()
    {
        $user = $this->session->userdata('email');
        if ($user) {
            if ( $this->session->userdata('group') == 0 or $this->session->userdata('group') == 1){
                return true;
            }else {
                return false;
            }
        }
        return false;
    }
}