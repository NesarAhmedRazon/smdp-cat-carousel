<?php 

!defined('ABSPATH') && exit; // Exit if accessed directly
require_once __DIR__ . '/ProductCategories.php';

class Templates {
    public static function posdCat(...$args) {
        return ProductCategories::html(...$args);
    }


}