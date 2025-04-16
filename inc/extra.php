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


function get_woocommerce_product_categories_hierarchical($parent = 0, $depth = 0, &$output = []) {
    // Get all product categories with the given parent
    $args = [
        'taxonomy'     => 'product_cat',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => false,
        'parent'       => $parent,
    ];

    $categories = get_terms($args);

    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            // Add dashes based on depth
            $prefix = str_repeat('- ', $depth);
            $output[$category->term_id] = $prefix . $category->name;

            // Recursive call for children
            get_woocommerce_product_categories_hierarchical($category->term_id, $depth + 1, $output);
        }
    }

    return $output;
}



function get_product_category($id) {
        // Get the category name by ID
        $category = get_term( $id, 'product_cat' );
        if ( ! is_wp_error( $category ) && ! empty( $category->name ) ) {
            $data = [];
            $data['id'] = $category->term_id;
            $data['name'] = $category->name;
            $data['link'] = get_term_link( $category );
            $data['image'] = get_term_meta( $category->term_id, 'thumbnail_id', true );
            $icon = get_term_meta( $category->term_id, 'category_icon', true );
            $data['icon'] =  $icon ? $icon : 'https://smdpicker.com/wp-content/uploads/2024/06/smdpicker_logo_v3.svg';
         
            $data['image'] = wp_get_attachment_url( $data['image'] );
            $data['count'] = $category->count ;
            
            return $data;
        }
        return '';
}
