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
class Import extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        if (! $this->is_logged_in_admin())
        {
            redirect(base_url('admin/login/login')); 
        }
        $this->load->model('admin/import_model');
        $this->load->library('pagination');
    }
    
    public function index(){
        $this->_loadAdminHeader();
        $data = array();
        $limit = 10;
        $config = array();
        $config["base_url"] = base_url() . "admin/import/index";
        $total_row = $this->import_model->count_all_results();
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
        $data["results"] = $this->import_model->get_all($config["per_page"], $page);
      
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        
        $this->load->view('admin/import/index', $data);
        $this->_loadAdminFooter();
    }
    
    public function add(){
        $this->_loadAdminHeader();
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $weight = $_POST['weight'];
            $product_qty = $_POST['product_qty'];
            $product_total_price = $_POST['product_total_price'];
            $versand_in_de = $_POST['versand_in_de'];
            $versand_to_vn = $_POST['versand_to_vn'];
            
            $data = array('name'=> $name,
                          'weight'=> floatval(str_replace(',', '.', $weight)),
                          'product_qty'=> floatval(str_replace(',', '.', $product_qty)),
                          'product_total_price'=> floatval(str_replace(',', '.', $product_total_price)),
                          'versand_in_de'=> floatval(str_replace(',', '.', $versand_in_de)),
                          'versand_to_vn'=> floatval(str_replace(',', '.', $versand_to_vn)),
                          'created' => date ("Y-m-d H:i:s")
                    );
            if ($this->import_model->insert($data)) {
                redirect('admin/import/index');
            } else{ 
                redirect('admin/import/add');
            }
        }
        $this->load->view('admin/import/add');
        $this->_loadAdminFooter();
    }
    
    public function edit(){
        $this->_loadAdminHeader();
        $id = $this->uri->segment(4);
        if (empty($id))
        {
            show_404();
        }
        $data['item'] = $this->import_model->get_one($id);
        if (!$data['item']) {
            redirect('admin/import/index');
        }
       
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $weight = $_POST['weight'];
            $product_qty = $_POST['product_qty'];
            $product_total_price = $_POST['product_total_price'];
            $versand_in_de =$_POST['versand_in_de'];
            $versand_to_vn = $_POST['versand_to_vn'];
            
            $data = array('name'=> $name,
                          'weight'=> floatval(str_replace(',', '.', $weight)),
                          'product_qty'=> floatval(str_replace(',', '.', $product_qty)),
                          'product_total_price'=> floatval(str_replace(',', '.', $product_total_price)),
                          'versand_in_de'=> floatval(str_replace(',', '.', $versand_in_de)),
                          'versand_to_vn'=> floatval(str_replace(',', '.', $versand_to_vn)),
                          'created' => date ("Y-m-d H:i:s")
                    );
            if ($this->import_model->update($id, $data)) {
                redirect('admin/import/index');
            } else{ 
                redirect('admin/import/add');
            }
        }
        $this->load->view('admin/import/edit', $data);
        $this->_loadAdminFooter();
    }
    
    public function delete()
    {
        $id = $this->uri->segment(4);
        
        if (empty($id))
        {
            show_404();
        }

        $this->import_model->del_one($id);        
        redirect('admin/import/index');  
    }
    
    public function test()
    {
        
        //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $this->load->library('excel');
        //$objReader= PHPExcel_IOFactory::createReader();	// For excel 2007 
        $file = FCPATH.'public/upload_files/excel/ex.xls';
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
        echo '<pre>';
        var_dump($data_user);die;
        $return = array(
            'hasError' => true,
            'data' => $data_user
        );
    }
    
    
}
