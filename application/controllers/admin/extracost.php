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
class Extracost extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        //$this->load->library('encryption');
        $this->load->model('admin/extracost_model'); 
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
        $config["base_url"] = base_url() . "admin/extracost/index";
        $total_row = $this->extracost_model->count_all_results( $search);
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
        $data["results"] = $this->extracost_model->get_all( $search, $config["per_page"], $page);
        
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        $data['search'] = $search;
        $this->load->view('admin/extracost/index', $data);
        $this->_loadAdminFooter();
    }
    
    public function add(){
        if (isset($_POST['author'])){  
            $price = $_POST['price'];
            $author = $_POST['author'];
            $notice = $_POST['notice'];
            $data = array(  
                        'price'=> $price,
                        'author'=> $author,
                        'notice'=> $notice,
                        'created' => now()
                    );
            if ($this->extracost_model->insert($data)) {
                redirect('admin/extracost');
            } else{ 
                redirect('admin/extracost/add');
            }
        }
        
        $this->_loadAdminHeader();
        $this->load->view('admin/extracost/add');
        $this->_loadAdminFooter();
    }
    
    public function edit(){
        $id = $this->uri->segment(4);
        if (empty($id)){
            show_404();
        }
        $extracost = $this->extracost_model->get_one($id);
       
        if (count ( (array)$extracost) == 0 ) {
            redirect('admin/extracost/index');
        }
        if (isset($_POST['author'])){  
            $price = $_POST['price'];
            $author = $_POST['author'];
            $notice = $_POST['notice'];
            $data = array(  
                        'price'=> $price,
                        'author'=> $author,
                        'notice'=> $notice,
                        'created' => now()
                    );
            if ($this->extracost_model->update($id, $data)) {
                redirect('admin/extracost/index');
            } else{ 
                redirect('admin/extracost/add');
            }
        }
        
        $this->_loadAdminHeader();
        
        $data['item'] = $extracost;
        $this->load->view('admin/extracost/edit', $data);
        $this->_loadAdminFooter();
    }
    
    public function delete()
    {
        $id = $this->uri->segment(4);
        if (empty($id)){
            show_404();
        }
        $product = $this->extracost_model->get_one($id);
        $this->extracost_model->del_one($id);        
        redirect('admin/extracost/index');  
    }
}
