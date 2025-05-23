<?php
/**
 * Plugin Name: SMDPicker Category Carousel
 * Plugin URI: https://github.com/NesarAhmedRazon/smdp-cat-carousel
 * Description: An Elementor widget to display a sliding carousel of WooCommerce product categories.
 * Version: 2.0.1
 * Author: Nesar Ahmed
 * Author URI: https://nesarahmed.dev/
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: smdp-cat-carousel
 * Domain Path: /languages
 * Requires at least: 5.8
 * Tested up to: 6.5
 * WC requires at least: 9.0
 * Elementor requires at least: 3.0
 * Elementor tested up to: 3.20
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Plugin Folder Path
if (!defined('SMDP_CAT_CAR_PLUGIN_DIR')) {
    define('SMDP_CAT_CAR_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
// Plugin Folder URL
if (!defined('SMDP_CAT_CAR_PLUGIN_URL')) {
    define('SMDP_CAT_CAR_PLUGIN_URL', plugin_dir_url(__FILE__));
}
// Plugin Root File
if (!defined('SMDP_CAT_CAR_PLUGIN_FILE')) {
    define('SMDP_CAT_CAR_PLUGIN_FILE', __FILE__);
}

// Extra Healpres
require_once( SMDP_CAT_CAR_PLUGIN_DIR . '/inc/extra.php' );

// 
function SMDP_CAT_CAR_carousel_dependencies() {
    
    wp_register_style( 'smdp-cat-carousel', SMDP_CAT_CAR_PLUGIN_URL.'assets/css/smdp-cat-carousel.css', [], time() );
    wp_register_script( 'smdp-cat-carousel', SMDP_CAT_CAR_PLUGIN_URL.'assets/js/smdp-cat-carousel.js', [ 'jquery'], time(), true );

    
        wp_enqueue_style('smdp-cat-carousel');
        wp_enqueue_script('smdp-cat-carousel');
        
}
//add_action('wp_enqueue_scripts', 'SMDP_CAT_CAR_carousel_dependencies');
add_action('elementor/frontend/after_enqueue_scripts', 'SMDP_CAT_CAR_carousel_dependencies',15);
add_action('elementor/editor/after_enqueue_scripts', 'SMDP_CAT_CAR_carousel_dependencies');


function register_carCar_control( $controls_manager ) {

	require_once( __DIR__ . '/controls/nested_select2.php' );

    $controls_manager->register( new \Nested_Select2_Control() );

}
add_action( 'elementor/controls/register', 'register_carCar_control' );

// Register the Widget
function register_carCar_Widget( $widgets_manager ) {  
    require_once( __DIR__ . '/widgets/carCar_Widget.php' );    
    require_once( __DIR__ . '/inc/device-check.php' );
    $widgets_manager->register( new \carCar_Widget() );
}
add_action( 'elementor/widgets/register', 'register_carCar_Widget' );


