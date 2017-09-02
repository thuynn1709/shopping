<?php

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function loadHeader()
    {
        echo 'fadfaf';die;
    }
    
    public function loadFooter(){
        $this->load->view('admin/admin_header');
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
}