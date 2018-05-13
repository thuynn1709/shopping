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
        $this->load->model('fproduct_model');
        $this->load->model('fproductcategory_model');
    }
    
    public function index(){
        
        $this->_loadFrontendHeader();
        $this->_loadFrontendProductJavascript();
        $this->_loadFrontendAdvertisement();
        $this->_loadFrontendLeftSlidebar();
        $this->load->view('frontend/product/index');
        $this->_loadFrontendFooter();   
    }
    
    public function test () {
        $this->_loadFrontendHeader();
        $this->_loadFrontendProductJavascript();
        $this->_loadFrontendAdvertisement();
        $this->_loadFrontendLeftSlidebar();
        $this->load->view('frontend/product/test');
        $this->_loadFrontendFooter();   
    }

    public function detail(){
        
        $this->_loadFrontendHeaderAccount();
        $this->_loadFrontendLeftSlidebar();
        $this->load->view('frontend/product/detail');
        $this->_loadFrontendFooter();
        
    }
}
