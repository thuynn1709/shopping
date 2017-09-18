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
class Import_detail extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        if (! $this->is_logged_in_admin())
        {
            redirect(base_url('admin/login/login')); 
        }
        $this->load->model('admin/importdetail_model');
        $this->load->model('admin/import_model');
        $this->load->model('admin/product_model');
        $this->load->library('pagination');
    }
    
    public function index(){
        $this->_loadAdminHeader();
        $import_id = $this->uri->segment(4);
        $data = array();
        $data['import'] = $this->import_model->get_one( $import_id);
        $data['import_id'] = $import_id;
        $limit = 10;
        $config = array();
        $config["base_url"] = base_url() . "admin/import_detail/index";
        $total_row = $this->importdetail_model->count_all_results( $import_id);
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
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data["results"] = $this->importdetail_model->get_all($import_id, $config["per_page"], $page);
      
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        
        $this->load->view('admin/import_detail/index', $data);
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
        
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $alias =  str_replace(' ', '-', trim($name));
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            
            $data = array('name'=> $name,
                          'priority'=>$priority,
                            'alias'=>$alias,
                          'status'=>$status,
                          'created' => date ("Y-m-d H:i:s")
                    );
            if ($this->importdetail_model->insert($data)) {
                redirect('admin/import_detail/index');
            } else{ 
                redirect('admin/import_detail/add');
            }
        }
        $this->load->view('admin/import_detail/add', $data);
        $this->_loadAdminFooter();
    }
    
    public function edit(){
        $this->_loadAdminHeader();
        $id = $this->uri->segment(4);
        if (empty($id))
        {
            show_404();
        }
      
        $data['item'] = $this->importdetail_model->get_one($id);
        if (!$data['item']) {
            redirect('admin/import_detail/index');
        }
       
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $alias =  str_replace(' ', '-', $name);
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            
            $data = array('name'=> $name,
                          'priority'=>$priority,
                          'alias'=>$alias,
                          'status'=>$status,
                          'created' => date ("Y-m-d H:i:s")
                    );
            if ($this->importdetail_model->update($id, $data)) {
                redirect('admin/import_detail/index');
            } 
        }
        $this->load->view('admin/import_detail/edit', $data);
        $this->_loadAdminFooter();
    }
    
    public function delete()
    {
        $id = $this->uri->segment(4);
        
        if (empty($id))
        {
            show_404();
        }

        $this->importdetail_model->del_one($id);        
        redirect('admin/import_detail/index');  
    }
    
    
}
