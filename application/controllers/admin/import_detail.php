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
        $import_id = $this->uri->segment(4);
        $all_name_products = $this->product_model->get_name_all_products();
        
        $all_products_id = array();
        foreach ( $all_name_products as $al) {
            $all_products_id[] = $al['name'];
        }
        $data['all_name_products'] = json_encode($all_products_id);
        
        if (isset($_POSTơ['count'])){
            
            $count = (int)$_POST['count'];
            $insert  = array();
            $update  = array();
            
            for( $i = 1; $i <= $count; $i++) {
                $field_id = 'field'.$i;
                $qty_id = 'qty'.$i;
                $product_name = $_POST[$field_id];
                $amount = (int)$_POST[$qty_id];
                $alias = sanitizeTitle($product_name);
                
                $structured_results = array();
                foreach($update as $key => $value)
                {
                    if( !isset($structured_results[$value['name']])) {
                        $structured_results[$value['name']] = array( 'alias' => $value['alias'] , 'amount' => $value['amount']);
                    } else {
                        $structured_results[$value['name']] = array('alias' => $value['alias'] , 'amount' => $value['amount'] + $structured_results[$value['name']]['amount'] );
                    }
                }

                echo '<pre>';
                var_dump($structured_results);
                
            }
            
            if (!empty($insert)) {
                $this->product_model->insert($insert, true);
            }
            if (!empty($update)) {
                $this->product_model->update_batch($update, 'alias');
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
    
    public function test(){
        $update = array();
        $update[0] = array('name' => '123', 'alias' => '123', 'amount' => 2, 'updated' => date ("Y-m-d H:i:s"));
        $update[1] = array('name' => '123', 'alias' => '123', 'amount' => 2, 'updated' => date ("Y-m-d H:i:s"));
        $update[2] = array('name' => '123', 'alias' => '123', 'amount' => 2, 'updated' => date ("Y-m-d H:i:s"));
        $update[3] = array('name' => '1', 'alias' => '1', 'amount' => 2, 'updated' => date ("Y-m-d H:i:s"));
        $update[4] = array('name' => '1', 'alias' => '1', 'amount' => 2, 'updated' => date ("Y-m-d H:i:s"));
        $update[5] = array('name' => '1', 'alias' => '1', 'amount' => 2, 'updated' => date ("Y-m-d H:i:s"));
        $structured_results = array();
        foreach($update as $key => $value)
        {
            //var_dump($key);
            //var_dump($value);die;
            if( !isset($structured_results[$value['name']])) {
                $structured_results[$value['name']] = array( 'alias' => $value['alias'] , 'amount' => $value['amount']);
            } else {
                $structured_results[$value['name']] = array('alias' => $value['alias'] , 'amount' => $value['amount'] + $structured_results[$value['name']]['amount'] );
            }
        }

        echo '<pre>';
        var_dump($structured_results);
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
                $FirstName= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
                $LastName= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
                $Email= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
                $Mobile=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
                $Address=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
                $data_user[]= array('FirstName'=>$FirstName, 'LastName'=>$LastName ,'Email'=>$Email ,'Mobile'=>$Mobile , 'Address'=>$Address);

            }
        }
    }
    
    
}
