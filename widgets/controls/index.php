<?php 

if(!defined('ABSPATH')){
    exit; // Exit if accessed directly
}

require_once __DIR__ . '/Heading.php';

class Controls {
    public static function heading(...$args) {
        return Heading::heading(...$args);
    }

}