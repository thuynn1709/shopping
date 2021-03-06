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
class Order extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        if (! $this->is_logged_in_admin())
        {
            redirect(base_url('admin/login/login')); 
        }
        $this->load->model('admin/productcategory_model');
        $this->load->model('admin/product_model');
        $this->load->model('admin/menu_model');
        $this->load->model('admin/order_model');
        $this->load->model('admin/orderdetail_model');
        $this->load->model('admin/sale_model');
        $this->load->model('admin/user_model');
        $this->load->library('pagination');
    }
    
    public function index(){
        
      
        $this->_loadAdminHeader();
        $search = '';
        $pay_method = '';
        $pay_status = '';
        $status = '';
        if ($_POST) {
            $search = $_POST['search'];
            $pay_method = $_POST['pay_method'];
            $pay_status = $_POST['pay_status'];
            $status = $_POST['status'];
        }
        $data = array();
        $limit = 20;
        $config = array();
        $config["base_url"] = base_url() . "admin/order/index";
        $total_row = $this->order_model->count_all_results( $search, $pay_method, $pay_status, $status);
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
        $offset = $this->uri->segment(4) > 0 ? (($this->uri->segment(4) + 0) * $config['per_page'] - $config['per_page']) : $this->uri->segment(4) ;
        
        $data["results"] = $this->order_model->get_all( $search, $pay_method, $pay_status, $status, $config["per_page"], $offset);
        $data["links"] = $this->pagination->create_links();

        // View data according to array.
        $data['search'] = $search;
        $data['offset'] = $offset;
        $this->load->view('admin/order/index', $data);
        $this->_loadAdminFooter();
    }
    
    public function add(){
        if (isset($_POST['name'])){  
            
            $name = $_POST['name'];
            $alias = sanitizeTitle($name);
            $check = $this->product_model->check_one_by_alias($alias);
            if( $check) {
                $this->session->set_flashdata('exist_name', 'Đã tồn tại sản phẩm với tên này !');
            }
            if(!$check) {
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

                $category = $_POST['category'];
                $marken = $_POST['marken'];
                $amount = $_POST['amount'];
                $img_thumb = $imageInfo[0]['file_name'];
                $img = $imageInfo[1]['file_name'];
                $img_1 = $imageInfo[2]['file_name'];
                $img_2 = $imageInfo[3]['file_name'];
                $img_3 = $imageInfo[4]['file_name'];
                $describe = $_POST['describe'];
                $expired = $_POST['expired'];
                $element = $_POST['element'];
                $guide = $_POST['guide'];
                $price = $_POST['price'];
                $discount = $_POST['discount'];
                $color = $_POST['color'];
                $status = $_POST['status'];
                $created = now();
                $updated = now();

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
    
    public function detail(){
        $id = $this->uri->segment(4);
        if (empty($id)){
            show_404();
        }
        $order = $this->order_model->get_one($id);
        if (count ( (array)$order) == 0 ) {
            redirect('admin/order/index');
        }
        $order_detail = $this->orderdetail_model->get_all_by_order_id($order->id);
        if (count ( (array)$order_detail) == 0 ) {
            redirect('admin/order/index');
        }
       
        $user = $this->user_model->get_one($order->user_id);
       
        if (isset($_POST['pay_status'])){  
            $pay_status = $_POST['pay_status'];
            $pay_method = $_POST['pay_method'];
            $status = $_POST['status'];
            $created = date('Y-m-d H:i:s');
            
            $data = array(
                'pay_status'=> $pay_status,
                'pay_method'=> $pay_method,
                'status'=> $status,
                'created'=> $created,
            );

            if ($this->order_model->update($id, $data)) {
                
                $orderDetail_ids = array();
                foreach ( $order_detail as $od) {
                    $orderDetail_ids[] = $od->id;
                }
                
                if ( $status == 1){
                    $checked = $this->sale_model->get_all_by_orderDetailId($orderDetail_ids);
                    if ( count((array)$checked) <= 0) {
                        $sale_insert = array();
                        foreach ( $order_detail as $od) {
                            $sale_insert[] = array(
                                'product_id' => $od->product_id,
                                'user_id' => $order->user_id,
                                'order_detail_id' => $od->id,
                                'price' => $od->price,
                                'discount' => $od->discount,
                                'amount' => $od->amount,
                                'pricetotal' => ($od->price * $od->amount ) - $od->discount,
                                'type' => 1,
                                'created' => now(),
                            );
                        }
                        $this->sale_model->insert($sale_insert, true);
                    }
                }else {
                    $this->sale_model->delete_by_orderDetailId($orderDetail_ids);
                }
                
                redirect('admin/order');
            } else{ 
                redirect('admin/order');
            }
        }
        
        $this->_loadAdminHeader();
        $data['user'] = $user;
        $data['item'] = $order;
        $data['results'] = $order_detail;
        $this->load->view('admin/order/detail', $data);
        $this->_loadAdminFooter();
    }
    
    public function delete_orderdetail_by_id()
    {
        $order_detail_id = $_POST['order_detail_id'];
        $order_id = $_POST['order_id'];
        
        $order = $this->order_model->get_one($order_id);
        $order_detail = $this->orderdetail_model->get_one($order_detail_id);
        
        $amount = $order->amount - $order_detail->amount;
        $price = $order->pricetotal - $order_detail->price;
        $data = array(
            'amount' => $amount,
            'pricetotal' => $price
        );
       
        if($this->orderdetail_model->del_one($order_detail_id)) {
            $this->order_model->update( $order_id, $data);
            $array = array ('msg' => 'success', 'amount' => $amount, 'price' => $price);
            echo json_encode($array);die;
        } else {
            $array = array ('msg' => 'error');
            echo json_encode($array);die;
        }
    }
    
    public function update_cart()
    {
        if ($_POST) {
            $order_detail_id = $_POST['order_detail_id'];
            $order_id = $_POST['order_id'];
            $discount = $_POST['discount'];
            $amount = $_POST['amount'];
            if ($this->orderdetail_model->update($order_detail_id, array ('amount' => $amount, 'discount' => $discount))){
                $all_orders = $this->orderdetail_model->get_all_by_order_id($order_id);
                $amount = 0;
                $pricetotal = 0;
                if (!empty((array)$all_orders)) {
                    foreach ($all_orders as $r) {
                        $amount += $r->amount;
                        $pricetotal += $r->amount * $r->price;
                    }

                    $data = array(
                    'amount' => $amount,
                    'pricetotal' => $pricetotal - $discount
                    );
                    $this->order_model->update( $order_id, $data);
                }
                $array = array ('msg' => 'success', 'amount' => $amount, 'price' => $pricetotal - $discount);
                echo json_encode($array);die;
            }
            $array = array ('msg' => 'error');
            echo json_encode($array);die;
        }
        $array = array ('msg' => 'error');
        echo json_encode($array);die;
    }        

    public function delete()
    {
        $id = $this->uri->segment(4);
        if (empty($id)){
            show_404();
        }
        $order = $this->order_model->get_one($id);
       
        if (count ( (array)$order) == 0 ) {
            redirect('admin/order');
        }
        
        $this->order_model->get_one($id);
        $this->orderdetail_model->del_all_by_orderId($id);
        redirect('admin/order');
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
