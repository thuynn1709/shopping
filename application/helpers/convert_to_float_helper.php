<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('parseFloat'))
{
    function parseFloat($value) {
        return  floatval(preg_replace('/[^0-9\.]/', '.', $value));
    }
}