<?php

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
    }
    
    public function _loadFrontendHeader(){
        $this->load->view('frontend/header');
    }
    
    public function _loadFrontendHeaderAccount(){
        $this->load->view('frontend/header_account');
    }
    
    public function _loadFrontendSlider(){
        $this->load->view('frontend/slider');
    }
    
    public function _loadFrontendLeftSlidebar(){
        $this->load->view('frontend/left-slidebar');
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