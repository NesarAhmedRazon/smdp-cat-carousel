<?php
/**
 * Plugin Name: SMDPicker Category Carousel
 * Plugin URI: https://github.com/NesarAhmedRazon/smdp-cat-carousel
 * Description: An Elementor widget to display a sliding carousel of WooCommerce product categories.
 * Version: 0.0.1
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


// 
function SMDP_CAT_CAR_carousel_dependencies() {
    
    wp_register_style( 'smdp-cat-carousel', SMDP_CAT_CAR_PLUGIN_URL.'assets/css/smdp-cat-carousel.css', [], time() );
    wp_register_script( 'smdp-cat-carousel', SMDP_CAT_CAR_PLUGIN_URL.'assets/js/smdp-cat-carousel.js', [ 'jquery' ], time(), true );
}
add_action('wp_enqueue_scripts', 'SMDP_CAT_CAR_carousel_dependencies');



function register_carCar_control( $controls_manager ) {

	require_once( __DIR__ . '/controls/carCar.php' );

    $controls_manager->register( new \SmdP_carCar_Control() );

}
add_action( 'elementor/controls/register', 'register_carCar_control' );

function register_carCar_Widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/carCar-widget.php' );
    
    require_once( __DIR__ . '/inc/device-check.php' );

	$widgets_manager->register( new \SmdP_carCar_Widget() );

}
add_action( 'elementor/widgets/register', 'register_carCar_Widget' );

function dumper($data) {
    if ( current_user_can( 'manage_options' ) ) {        
        var_dump($data);
    }
}

function enTobnNumber($number) {
    return strtr((string)$number, ['0'=>'০', '1'=>'১', '2'=>'২', '3'=>'৩', '4'=>'৪', '5'=>'৫', '6'=>'৬', '7'=>'৭', '8'=>'৮', '9'=>'৯']);
}