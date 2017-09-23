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
        if (! $this->is_logged_in_admin())
        {
            redirect(base_url('admin/login')); 
        }
        $this->load->model('admin/product_model');
        $this->load->library('pagination');
        $this->load->library('upload');
    }
    
    public function index(){
        $this->_loadAdminHeader();
        $data = array();
        $limit = 10;
        $config = array();
        $config["base_url"] = base_url() . "admin/slidebar/index";
        $total_row = $this->slidebar_model->count_all_results();
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
        $data["results"] = $this->slidebar_model->get_all($config["per_page"], $page);
      
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        
        $this->load->view('admin/slidebar/index', $data);
        $this->_loadAdminFooter();
    }
    
    public function add(){
        $this->_loadAdminHeader();
        $error['error'] = '';
        if (isset($_POST['title'])){
            $img = '';
            $this->upload->initialize($this->set_upload_options());
            if ( ! $this->upload->do_upload('img')){
                $error['error'] = $this->upload->display_errors();
            } else{
                $img = $this->upload->data('file_name');
                $title = $_POST['title'];
                $describe = $_POST['describe'];
                $link = $_POST['link'];
                $status = $_POST['status'];

                $data = array('title'=> $title,
                              'describe'=> $describe,
                              'link'=> $link,
                              'img'=> $img,
                              'status' => $status,
                              'created' => date ("Y-m-d H:i:s")
                        );
                if ($this->slidebar_model->insert($data)) {
                    redirect('admin/slidebar/index');
                } else{ 
                    redirect('admin/slidebar/add');
                }
            }
        }
        $this->load->view('admin/slidebar/add', $error);
        $this->_loadAdminFooter();
    }
    
    public function edit(){
        $this->_loadAdminHeader();
        $id = $this->uri->segment(4);
        if (empty($id))
        {
            show_404();
        }
        $data['item'] = $this->slidebar_model->get_one($id);
        if (!$data['item']) {
            redirect('admin/slidebar/index');
        }
       
        $data['error'] = '';
        if (isset($_POST['title'])){
            $img = '';
            $this->upload->initialize($this->set_upload_options());
            if ( ! $this->upload->do_upload('img')){
                $data['error'] = $this->upload->display_errors();
            } else{
                $img = $this->upload->data('file_name');
                $title = $_POST['title'];
                $describe = $_POST['describe'];
                $link = $_POST['link'];
                $status = $_POST['status'];

                $data = array('title'=> $title,
                              'describe'=> $describe,
                              'link'=> $link,
                              'img'=> $img,
                              'status' => $status,
                              'created' => date ("Y-m-d H:i:s")
                        );
                if ($this->slidebar_model->insert($data)) {
                    redirect('admin/slidebar/index');
                } else{ 
                    redirect('admin/slidebar/add');
                }
            }
        }
       
        $this->load->view('admin/slidebar/edit', $data);
        $this->_loadAdminFooter();
    }
    
    public function delete()
    {
        $id = $this->uri->segment(4);
        
        if (empty($id))
        {
            show_404();
        }

        $this->slidebar_model->del_one($id);        
        redirect('admin/slidebar/index');  
    }
    
    public function test()
    {
        
        $file = './ex.xlsx';

        //load the excel library
        $this->load->library('excel');

        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }

        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;
        echo '<pre>';
        var_dump($data['header']);die;
    }
    
    private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = './public/images/slidebar/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }
    
    
}
