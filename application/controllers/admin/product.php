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
class Product extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/productcategory_model');
        $this->load->model('admin/product_model');
        $this->load->model('admin/menu_model');
        $this->load->library('pagination');
    }
    
    public function index(){
        
        $this->_loadAdminHeader();
        
        $data = array();
        $limit = 10;
        $config = array();
        $config["base_url"] = base_url() . "admin/product/index";
        $total_row = $this->product_model->count_all_results();
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
        $data["results"] = $this->product_model->get_all($config["per_page"], $page);
        
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        
        $this->load->view('admin/product/index', $data);
        $this->_loadAdminFooter();
    }
    
    public function add(){
        $this->_loadAdminHeader();
        $menu = array();
        $menu = $this->menu_model->get_all();
        
        if (isset($_POST['name'])){
            
            $name = $_POST['name'];
            $alias =  str_replace(' ', '-', trim($name));
            $priority = $_POST['priority'];
            $status = $_POST['status'];
            $menu_id = $_POST['menu_id'];
            
            $data = array('name'=> $name,
                          'priority'=>$priority,
                          'alias'=>$alias,
                          'status'=>$status,
                          'menu_id' => $menu_id,
                          'created' => date ("Y-m-d H:i:s")
                    );
            if ($this->product_model->insert($data)) {
                redirect('admin/product/index');
            } else{ 
                redirect('admin/product/add');
            }
        }
        
        $data['menu'] = $menu;
        $this->load->view('admin/product/add', $data);
        $this->_loadAdminFooter();
    }
    
    public function edit(){
        $this->_loadAdminHeader();
        $id = $this->uri->segment(4);
        if (empty($id))
        {
            show_404();
        }
        
      
        $data['item'] = $this->menu_model->get_one($id);
        if (!$data['item']) {
            redirect('admin/product/index');
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
            if ($this->product_model->update($id, $data)) {
                redirect('admin/product/index');
            } 
        }
        
        $menu = array();
        $menu = $this->menu_model->get_all();
        $data['menu'] = $menu;
        
        $this->load->view('admin/product/edit', $data);
        $this->_loadAdminFooter();
    }
    
    public function delete()
    {
        $id = $this->uri->segment(4);
        
        if (empty($id))
        {
            show_404();
        }

        $this->product_model->del_one($id);        
        redirect('admin/product/index');  
    }
}
