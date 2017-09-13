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
        $this->load->model('admin/marken_model');
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
        if (isset($_POST['name'])){  
            $this->load->library('upload');
            $imageInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['images']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['images']['name']= $files['images']['name'][$i];
                $_FILES['images']['type']= $files['images']['type'][$i];
                $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
                $_FILES['images']['error']= $files['images']['error'][$i];
                $_FILES['images']['size']= $files['images']['size'][$i];    
                    
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('images');
                $imageInfo[] = $this->upload->data();
            }
            
            $name = $_POST['name'];
            $alias =  str_replace(' ', '-', trim($name));
            $category = $_POST['category'];
            $marken = $_POST['marken'];
            $amount = $_POST['amount'];
            $img_thumb = $imageInfo[0]['name'];
            $img = $imageInfo[1]['name'];
            $img_1 = $imageInfo[2]['name'];
            $img_2 = $imageInfo[3]['name'];
            $img_3 = $imageInfo[4]['name'];
            $describe = $_POST['describe'];
            $expired = $_POST['expired'];
            $element = $_POST['element'];
            $guide = $_POST['guide'];
            $warning = $_POST['warning'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $color = $_POST['color'];
            $status = $_POST['status'];
            $created = date('Y-m-d H:i:s');
            $updated = date('Y-m-d H:i:s');
            
            $data = array('name'=> $name,
                        'alias'=> $alias,
                        'category_id'=> $category,
                        'marken_id'=> $marken,
                        'amount'=> $amount,
                        'img_thumb' => $img_thumb,
                        'img' => $img,
                        'img_1' => $img_1,
                        'img_2' => $img_2,
                        'img_3' => $img_3,
                        'describe' => $describe,
                        'expired' => $expired,
                        'element' => $element,
                        'guide' => $guide,
                        'warning' => $warning,
                        'price' => $price,
                        'discount' => $discount,
                        'color' => $color,
                        'status' => $status,
                        'created' => $created,
                        'updated' => $updated
                    );
            
            if ($this->product_model->insert($data)) {
                redirect('admin/product/index');
            } else{ 
                redirect('admin/product/add');
            }
        }
        
        $this->_loadAdminHeader();
        $marken = array();
        $category = array();
        $marken = $this->marken_model->get_all();
        $category = $this->productcategory_model->get_all();
        $data['marken'] = $marken;
        $data['category'] = $category;
        $this->load->view('admin/product/add', $data);
        $this->_loadAdminFooter();
    }
    
    public function edit(){
        $id = $this->uri->segment(4);
        if (empty($id)){
            show_404();
        }
      
        $product = $this->product_model->get_one($id);
        if (!$data['item']) {
            redirect('admin/product/index');
        }
       
        if (isset($_POST['name'])){  
            $this->load->library('upload');
            $imageInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['images']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['images']['name']= $files['images']['name'][$i];
                $_FILES['images']['type']= $files['images']['type'][$i];
                $_FILES['images']['tmp_name']= $files['images']['tmp_name'][$i];
                $_FILES['images']['error']= $files['images']['error'][$i];
                $_FILES['images']['size']= $files['images']['size'][$i];    
                    
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload('images');
                $imageInfo[] = $this->upload->data();
            }
            
            $name = $_POST['name'];
            $alias =  str_replace(' ', '-', trim($name));
            $category = $_POST['category'];
            $marken = $_POST['marken'];
            $amount = $_POST['amount'];
            $img_thumb = $imageInfo[0]['name'];
            $img = $imageInfo[1]['name'];
            $img_1 = $imageInfo[2]['name'];
            $img_2 = $imageInfo[3]['name'];
            $img_3 = $imageInfo[4]['name'];
            $describe = $_POST['describe'];
            $expired = $_POST['expired'];
            $element = $_POST['element'];
            $guide = $_POST['guide'];
            $warning = $_POST['warning'];
            $price = $_POST['price'];
            $discount = $_POST['discount'];
            $color = $_POST['color'];
            $status = $_POST['status'];
            $created = date('Y-m-d H:i:s');
            $updated = date('Y-m-d H:i:s');
            
            $data = array('name'=> $name,
                        'alias'=> $alias,
                        'category_id'=> $category,
                        'marken_id'=> $marken,
                        'amount'=> $amount,
                        'img_thumb' => $img_thumb,
                        'img' => $img,
                        'img_1' => $img_1,
                        'img_2' => $img_2,
                        'img_3' => $img_3,
                        'describe' => $describe,
                        'expired' => $expired,
                        'element' => $element,
                        'guide' => $guide,
                        'warning' => $warning,
                        'price' => $price,
                        'discount' => $discount,
                        'color' => $color,
                        'status' => $status,
                        'created' => $created,
                        'updated' => $updated
                    );
            
            if ($this->product_model->insert($data)) {
                redirect('admin/product/index');
            } else{ 
                redirect('admin/product/add');
            }
        }
        
        $this->_loadAdminHeader();
        $marken = array();
        $category = array();
        $marken = $this->marken_model->get_all();
        $category = $this->productcategory_model->get_all();
        $data['marken'] = $marken;
        $data['category'] = $category;
        $data['item'] = $product;
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
