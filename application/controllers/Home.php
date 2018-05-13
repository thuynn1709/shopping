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
        $this->load->model('admin/featuresitems_model');
        $this->load->model('admin/smallmenuitems_model');
        $this->load->model('fproduct_model');
        $this->load->model('fproductcategory_model');
    }
    
    public function index(){
        
        $this->_loadFrontendHeader();
        $this->_loadFrontendHomeJavascript();
        $this->_loadFrontendSlider();
        $this->_loadFrontendLeftSlidebar();
        
        // list sản phẩm mới
        $features = array();
        $features = $this->featuresitems_model->get_all(6,0);
        $f_ids = array();
        foreach ($features as $f) {
            $f_ids[] = $f->product_id;
        }
        $features = $this->fproduct_model->get_all_by_Ids($f_ids);
        
        // list danh mục sản phẩm ở menu con
        $smallmenus = array();
        $smallmenus = $this->smallmenuitems_model->get_all(6);
        $list_small_menus = array();
        foreach ($smallmenus as $f) {
            $list_small_menus[$f->category_id]['name'] = $f->category_name;
            $list_small_menus[$f->category_id]['alias'] = sanitizeTitle($f->category_name);
            $list_small_menus[$f->category_id]['details'] = $this->fproduct_model->get_all_by_categoryId($f->category_id, 4);
        }
        $active = '';
        if (!empty($list_small_menus)) {
            $first_key = key($list_small_menus);
            $active = $list_small_menus[$first_key]['alias'];
        }
        // list sản phẩm RECOMMENDED ITEMS;
        $recommend_items = array();
        $recommend_items = $this->fproduct_model->get_recommend_items();
        $recommend_items = array_chunk($recommend_items, 3);
        
        $data['recommend_items'] = $recommend_items;
        $data['list_small_menus'] = $list_small_menus;
        $data['features'] = $features;
        $data['active_small_menu'] = str_replace('-','',$active);
        $this->load->view('frontend/home/index', $data);
        
        $this->_loadFrontendFooter();
        
    }
}
