<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."/third_party/PHPExcel.php";

/**
 * Description of Excel
 *
 * @author KT5
 */
class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
