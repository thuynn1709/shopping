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
class User extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        //$this->load->library('encryption');
        $this->load->model('admin/user_model'); 
        $this->load->library('pagination');
    }
    
    public function index(){
        $this->_loadAdminHeader();
        $search = '';
        if ($_POST) {
            $search = $_POST['search'];
        }
        $data = array();
        $limit = 10;
        $config = array();
        $config["base_url"] = base_url() . "admin/user/index";
        $total_row = $this->user_model->count_all_results( $search);
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["results"] = $this->user_model->get_all( $search, '', $config["per_page"], $page);
        
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        $data['search'] = $search;
        $this->load->view('admin/user/index', $data);
        $this->_loadAdminFooter();
    }
    
    public function add(){
        if (isset($_POST['name'])){  
            
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = sha1($_POST['password']);
            $group = $_POST['group'];
            $status = $_POST['status'];
           
            $data = array(  'fullname'=> $name,
                            'email'=> $email,
                            'password'=> $password,
                            'group'=> $group,
                            'status'=> $status,
                            'created' => now()
                    );
            if ($this->user_model->insert($data)) {
                redirect('admin/user/index');
            } else{ 
                redirect('admin/user/add');
            }
        }
        
        $this->_loadAdminHeader();
     
        $this->load->view('admin/user/add');
        $this->_loadAdminFooter();
    }
    
    public function edit(){
        $id = $this->uri->segment(4);
        if (empty($id)){
            show_404();
        }
        $user = $this->user_model->get_one($id);
       
        if (count ( (array)$user) == 0 ) {
            redirect('admin/user/index');
        }
        if (isset($_POST['name'])){  
            
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = !empty($_POST['password']) ? sha1($_POST['password']) : $user->password;
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $group = $_POST['group'];
            $status = $_POST['status'];
           
            $data = array(  'fullname'=> $name,
                            'email'=> $email,
                            'password'=> $password,
                            'phone'=> $phone,
                            'address'=> $address,
                            'group'=> $group,
                            'status'=> $status,
                            'created' => now()
                    );
            if ($this->user_model->update($id, $data)) {
                redirect('admin/user/index');
            } else{ 
                redirect('admin/user/add');
            }
        }
        
        $this->_loadAdminHeader();
        
        $data['item'] = $user;
        $this->load->view('admin/user/edit', $data);
        $this->_loadAdminFooter();
    }
    
    public function delete()
    {
        $id = $this->uri->segment(4);
        if (empty($id)){
            show_404();
        }
        $product = $this->user_model->get_one($id);
        $this->user_model->del_one($id);        
        redirect('admin/user/index');  
    }
    
    private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = './public/images/products/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }
   
}
