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
class Contact extends MY_Controller {
    //put your code here
            
    private $b_Check = true;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library(array('form_validation','session'));
        $this->load->model('admin/contact_model');
    }
    
    public function index(){
        $this->_loadFrontendHeaderAccount();
        $this->load->view('frontend/contact/index');
        $this->_loadFrontendFooter();
    }
    
    public function register_contact(){
        if($_POST){
            
            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|min_length[1]');
            $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[1]');

            #Kiểm tra điều kiện validate
            if($this->form_validation->run() == TRUE){
                
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $name = $this->input->post('name');
                $subject = $this->input->post('subject');
                $message = $this->input->post('message');

                $insert_array = array(
                    'email'     => $email,
                    'phone' => $phone,
                    'name' => $name,
                    'subject' => $subject,
                    'message' => $message,
                    'status' => 0,
                    'created' => now()
                );
                try { 
                    $this->contact_model->insert($insert_array);
                    $array = array ('msg' => 'success');
                    echo json_encode($array);die;
                } catch (Exception $e) {
                    $array = array ('msg' => 'error');
                    echo json_encode($array);die;
                }
            } else {
                $array = array ('msg' => 'error');
                echo json_encode($array);die;                
            }
        }
        $array = array ('msg' => 'error');
        echo json_encode($array);die;     
    }
}
