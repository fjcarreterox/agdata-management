<?php
/**
 * Created by PhpStorm.
 * User: motillaPalace
 * Date: 16/08/2015
 * Time: 19:12
 */

//HELPERS
function date_conv($str_date){
    $date=explode('-',$str_date);
    return $date[2]."-".$date[1]."-".$date[0];
}