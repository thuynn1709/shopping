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
class Account extends MY_Controller {
    //put your code here
            
    private $b_Check = true;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('fuser_model');
    }
    
    public function login(){
        $this->_loadFrontendHeaderAccount();
        $this->load->view('frontend/account/login_register');
        $this->_loadFrontendFooter();
    }
    
    public function register(){
        $this->_loadFrontendHeader();
        $this->load->view('frontend/account/login_register');
        $this->_loadFrontendFooter();
    }
    
    public function register_process(){
        if( $this->session->has_userdata('email')){
            redirect(base_url('account'));
        }else {
            if(isset($_POST['act']) && $_POST['act'] == 'register' ){
              
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
                #Kiểm tra điều kiện validate
                if($this->form_validation->run() == TRUE){
                    $a_UserInfo['email'] = $this->input->post('email');
                    $a_UserInfo['password'] = sha1($this->input->post('password'));
                    $this->session->set_userdata('remember_me', $this->input->post('remember_me'));
                    $a_UserChecking = $this->fuser_model->check_user( $a_UserInfo );
                    if($a_UserChecking){
                            $user_info = array(
                                'email'     => $a_UserChecking->email,
                                'fullname' => $a_UserChecking->fullname,
                            );
                            $this->session->set_userdata($user_info);
                            redirect(base_url('home'));
                    }
                    $this->b_Check = false;
                }
            }
        }
        $a_Data['b_Check']= $this->b_Check;
        $this->load->view('admin/login/login', $a_Data);
    }
    
    public function login_process(){
        if( $this->session->has_userdata('email')){
            redirect(base_url('home'));
        }else {
            if(isset($_POST['act']) && $_POST['act'] == 'login' ){
                
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
                #Kiểm tra điều kiện validate
                if($this->form_validation->run() == TRUE){
                    $a_UserInfo['email'] = $this->input->post('email');
                    $a_UserInfo['password'] = sha1($this->input->post('password'));
                    $this->session->set_userdata('remember_me', $this->input->post('remember_me'));
                    $a_UserChecking = $this->fuser_model->check_user( $a_UserInfo );
                    if($a_UserChecking){
                            $user_info = array(
                                'email'     => $a_UserChecking->email,
                                'fullname'     => $a_UserChecking->fullname,
                            );
                            $this->session->set_userdata($user_info);
                            redirect(base_url('home'));
                    }
                    $this->b_Check = false;
                }
            }
        }
        $a_Data['b_Check']= $this->b_Check;
        $this->load->view('admin/login/login', $a_Data);
    }
    
    public function logout(){
        $this->session->sess_destroy();	// Unset session of user
        redirect(base_url('admin/login/login'));
    }
}
