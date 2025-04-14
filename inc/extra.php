<?php 

!defined('ABSPATH') && exit; // Exit if accessed directly

if (!function_exists('enTobnNumber')) {
    function enTobnNumber($number) {
        return strtr((string)$number, ['0'=>'০', '1'=>'১', '2'=>'২', '3'=>'৩', '4'=>'৪', '5'=>'৫', '6'=>'৬', '7'=>'৭', '8'=>'৮', '9'=>'৯']);
    }
}


if (!function_exists('dumper')) {
    function dumper($data) {
        if ( current_user_can( 'manage_options' ) ) {        
            var_dump($data);
        }
    }
}
