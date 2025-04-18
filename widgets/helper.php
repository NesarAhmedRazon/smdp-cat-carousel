<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class SMDP_Category_Helper {
    
    /**
     * Get hierarchical product categories
     * 
     * @param int $parent Parent category ID
     * @param int $level Nesting level
     * @return array
     */
public static function get_hierarchical_categories($parent = 0, $level = 0) {
    $args = [
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'parent'     => $parent,
        'orderby'    => 'name',
        'order'      => 'ASC'
    ];
    
    $categories = get_terms($args);
    $hierarchy = [];

    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            $hierarchy[] = [
                'id'     => $category->term_id,
                'name'   => $category->name,
                'icon'   => wp_get_attachment_url(get_term_meta($category->term_id, 'thumbnail_id', true)),
                'level'  => $level // Track depth level
            ];

            // Recursively fetch children with incremented level
            $hierarchy = array_merge($hierarchy, self::get_hierarchical_categories($category->term_id, $level + 1));
        }
    }

    return $hierarchy;
}

    public static function get_hierarchical_categoriess($parent = 0) {
    $args = [
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'parent'     => $parent,
        'orderby'    => 'name',
        'order'      => 'ASC'
    ];
    
    $categories = get_terms($args);
    $hierarchy = [];

    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            $hierarchy[$category->term_id] = [
                'id'       => $category->term_id,
                'name'     => $category->name,
                'icon'     => wp_get_attachment_url(get_term_meta($category->term_id, 'thumbnail_id', true)),
                'children' => self::get_hierarchical_categoriess($category->term_id) // Recursively fetch children
            ];
        }
    }
    
    return array_values($hierarchy); // Ensure numeric index for JSON output
}


    /**
     * Get complete category data
     * 
     * @param int $id Category ID
     * @return array|string
     */
    public static function get_category_data($id) {
        $category = get_term($id, 'product_cat');
        if (!is_wp_error($category) && !empty($category->name)) {
            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $icon_meta = get_term_meta($category->term_id, 'category_icon_alt', true);
            
            return [
                'id'     => $category->term_id,
                'name'   => $category->name,
                'link'   => get_term_link($category),
                'image'  => $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '',
                'icon'   => is_array($icon_meta) && isset($icon_meta['url']) ? $icon_meta['url'] : '',
                'count'  => $category->count,
                'parent' => $category->parent
            ];
        }
        
        return '';
    }
    
    /**
     * Group categories by parent
     * 
     * @param array $categories
     * @return array
     */
    public static function group_by_parent($categories) {
        $grouped = [];
        
        foreach ($categories as $category) {
            $cat_data = self::get_category_data($category['cat_carousel_cat']);
            if ($cat_data) {
                $grouped[$cat_data['parent']][] = $cat_data;
            }
        }
        
        return $grouped;
    }
}