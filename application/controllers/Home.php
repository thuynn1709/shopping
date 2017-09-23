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
class Home extends MY_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->_loadFrontendHeader();
        $this->_loadFrontendSlider();
        $this->_loadFrontendLeftSlidebar();
        $this->_loadFrontendContent();
        $this->_loadFrontendFooter();
    }
}
