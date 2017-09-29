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
        $limit = 20;
        $config = array();
        $total_row = $this->importdetail_model->count_all_results( $import_id);
        $config["base_url"] = base_url() . "admin/import_detail/index/". $import_id;
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
        $offset = 0;
        $offset = $this->uri->segment(5) > 0 ? (($this->uri->segment(5) + 0) * $config['per_page'] - $config['per_page']) : $this->uri->segment(5) ;
        
        $data["results"] = $this->importdetail_model->get_all($import_id, $config["per_page"], $offset);
       //get_all_by_importId
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        
        $data['offset'] = $offset;
        $this->load->view('admin/import_detail/index', $data);
        $this->_loadAdminFooter();
    }
    
    public function add(){
        $this->_loadAdminHeader();
        $import_id = $this->uri->segment(4);
        $all_name_products = $this->product_model->get_name_all_products();
        
        $all_products_id = array();
        foreach ( $all_name_products as $al) {
            $all_products_id[] = $al['name'];
        }
        $data['all_name_products'] = json_encode($all_products_id);
        
        if (isset($_POST['count'])){
            $count = (int)$_POST['count'];
            $insert_array  = array();
            for( $i = 1; $i <= $count; $i++) {
                $field_id = 'field'.$i;
                $qty_id = 'qty'.$i;
                $price_id = 'price'.$i;
                $product_name = $_POST[$field_id];
                $price = ($_POST[$price_id]);
                $amount = (int)$_POST[$qty_id];
                $alias = sanitizeTitle($product_name);
                $insert_array[] = array(
                    'product_name' => $product_name ,
                    'product_alias' => sanitizeTitle($product_name) , 
                    'price' => $price,
                    'amount' => $amount,
                    'status' => 0,
                    'created' => now()
                );
            }
                
            $structured_results = array();
            foreach($insert_array as $key => $value)
            {
                if( !isset($structured_results[$value['product_alias']])) {
                    $structured_results[$value['product_alias']] = array( 
                        'import_id' => $import_id,
                        'product_name' => $value['product_name'] ,
                        'product_alias' => $value['product_alias'], 
                        'price' => $price,
                        'amount' => $value['amount'],
                        'status' => 0,
                        'created' =>  now(),
                        'updated' =>  now()
                    );
                } else {
                    $structured_results[$value['product_alias']] = array(
                        'import_id' => $import_id,
                        'product_name' => $value['product_name'] ,
                        'product_alias' => $value['product_alias'], 
                        'price' => $price,
                        'amount' => $value['amount'] + $structured_results[$value['product_alias']]['amount'],
                        'status' => 0,
                        'created' =>  now(),
                        'updated' =>  now()
                    );
                }
            }

            if (!empty($structured_results)) {
                $this->importdetail_model->insert($structured_results, true);
            }
            redirect('admin/import_detail/index/'. $import_id);
        }
        
        
        $data['import'] = $this->import_model->get_one( $import_id);
        $data['import_id'] = $import_id;
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
            redirect('admin/import');
        }
        $import_id = $data['item']->import_id;
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
           
            $amount = $_POST['amount'];
            $data = array('product_name'=> $name,
                          'product_alias' => sanitizeTitle($name),
                          'price'=> floatval(str_replace(',', '.', $price)),
                          'amount'=>$amount,
                          'status'=> $data['item']->status,
                          'updated' => now()
                    );
            
                    //var_dump($data);die;
            if ($this->importdetail_model->update($id, $data)) {
                redirect(base_url('admin/import_detail/index/'. $import_id));
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
    
    public function import_to_product(){
        $import_id = $this->uri->segment(4);
        $all_products_by_importId = array();
        $all_products_by_importId = $this->importdetail_model->get_all_by_importId($import_id);
        
        $structured_results = array();
        foreach($all_products_by_importId as $key => $value)
        {
            if( !isset($structured_results[$value->product_alias])) {
                $structured_results[$value->product_alias] = array( 
                   
                    'product_name' => $value->product_name ,
                    'product_alias' => $value->product_alias, 
                    'amount' => $value->amount,
                );
            } else {
                $structured_results[$value->product_alias] = array(
                    
                    'product_name' => $value->product_name ,
                    'product_alias' => $value->product_alias, 
                    'amount' => $value->amount + $structured_results[$value->product_alias]['amount'],
                );
            }
        }
        
        $insert_batch = array();
        $update_batch = array();
        
        foreach( $structured_results as $r) {
            if ($this->product_model->check_one_by_alias($r['product_alias'])) {
                $update_batch[] = array(
                    'alias' => $r['product_alias'],
                    'amount' => $r['amount'],
                    'updated' =>  now()
                );
            }else {
                $insert_batch[] = array(
                    'name' => $r['product_name'],
                    'alias' => $r['product_alias'],
                    'amount' => $r['amount'],
                    'status' => 0,
                    'created' =>  now(),
                    'updated' =>  now()
                );
            }
        }
        
        if(!empty($insert_batch)) {
            $this->product_model->insert($insert_batch, true);
        }
        if(!empty($update_batch)) {
            $this->product_model->update_batch( $update_batch, 'alias'); 
        }
        $this->session->set_flashdata('success', 'Import dữ liệu thành công!');
        redirect('admin/product/index');  
    }

    public function import_excel() {
        if (isset($_POST['import_id'])){
            $import_id = $_POST['import_id'];
            //Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
            $configUpload['upload_path'] = FCPATH.'public/upload_files/excel/';
            $configUpload['allowed_types'] = 'xls|xlsx|csv';
            $configUpload['max_size'] = '5000';
            $this->load->library('upload', $configUpload);
            $this->upload->do_upload('excel');	
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name']; //uploded file name
            $extension=$upload_data['file_ext'];    // uploded file extension
            
            $this->load->library('excel');
            //$objReader= PHPExcel_IOFactory::createReader();	// For excel 2007 
            $file = FCPATH.'public/upload_files/excel/'. $file_name;
            $objReader = PHPExcel_IOFactory::load($file);
            //Set to read only
            //$objReader->setReadDataOnly(true); 		  
            //Load excel file
            //$objPHPExcel= $objReader->load(FCPATH.'public/upload_files/excel/'.$file_name);		 
            $totalrows= $objReader->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
            $objWorksheet= $objReader->setActiveSheetIndex(0);                
            //loop from first data untill last data
            $data_user = array();
            for( $i=2; $i<=$totalrows; $i++)
            {
                if ( $objWorksheet->getCellByColumnAndRow(0,$i)->getValue() != '') {
                    $product_name = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();	
                
                    $product_alilas = sanitizeTitle($product_name);
                    $price = $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
                    $qty = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2

                    $data_user[]= array(
                        'import_id' => $import_id,
                        'product_name'=> $product_name, 
                        'product_alias '=> $product_alilas ,
                        'price'=> floatval(str_replace(',', '.', $price)), 
                        'amount'=> $qty,
                        'status' => 0,
                        'created' =>  now(),
                        'updated' =>  now()
                    );
                }
            }
            unlink($file);
            $check = $this->importdetail_model->insert($data_user, true);
            if ($check) {
                $this->session->set_flashdata('success', 'Thêm mới thành công!');
                echo 'ok';die;
            }
            $this->session->set_flashdata('error', 'Không thành công  !');
            echo 'notok';die;
        }
    }
    
    
}
