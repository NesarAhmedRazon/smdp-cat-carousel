<?php 

if(!defined('ABSPATH')){
    exit; // Exit if accessed directly
}

require_once __DIR__ . '/Heading.php';
require_once __DIR__ . '/Counter.php';
require_once __DIR__ . '/Items.php';

class Controls {
    public static function heading(...$args) {
        return Heading::heading(...$args);
    }
    public static function items(...$args) {
        return Items::controls(...$args);
    }
    public static function counter(...$args) {
        return Counter::controls(...$args);
    }

}