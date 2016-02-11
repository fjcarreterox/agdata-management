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

function getMes($num_mes){
    $month_name = "";
    switch($num_mes){
        case 1: $month_name="Enero";break;
        case 2: $month_name="Febrero";break;
        case 3: $month_name="Marzo";break;
        case 4: $month_name="Abril";break;
        case 5: $month_name="Mayo";break;
        case 6: $month_name="Junio";break;
        case 7: $month_name="Julio";break;
        case 8: $month_name="Agosto";break;
        case 9: $month_name="Septiembre";break;
        case 10: $month_name="Octubre";break;
        case 11: $month_name="Noviembre";break;
        case 12: $month_name="Diciembre";break;
    }
    return $month_name;
}