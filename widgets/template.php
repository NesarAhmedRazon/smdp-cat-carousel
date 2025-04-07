<?php

/**
 * Template for the Elementor widget.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
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
            $data['icon'] =  get_term_meta($category->term_id, 'category_icon_alt', true)['url'];
            $data['image'] = wp_get_attachment_url( $data['image'] );
            $data['count'] = $category->count ;
            return $data;
        }
        return '';
}

function smdp_cat_car_template($data,$id='smdp_catCar',$rawData=[]) {
    if( !is_array($data)) {
        return;
    }

    $categories = $data['categories'];
        if ( empty( $categories ) ) {
            return;
        }

    $showCounter = $data['show_counter'] === 'yes' ? true : false;
        $ln = $data['smdp_counter_lng'];
        $showIcon = $data['smdp_show_icon'] === 'yes' ? true : false;
        $deviceType = getDeviceType();
        $postFix = $deviceType == 'desktop' ? 'smdp_show_icon' : 'smdp_show_icon_'.$deviceType;
        $showIcon = $data[$postFix] === 'yes' ? true : false;        
        
        $sec_title = $data[$id.'_heading_text'] !== '' ? $data[$id.'_heading_text'] : esc_html__( 'Categories', 'smdp-cat-carousel' );

    ?>
    <section class="smdp-category-scroll" data-device="<?php echo esc_attr( $deviceType ); ?>" >   
            <div class="smdp-category-scroll-title"><?= esc_html($sec_title); ?></div> 
            <div class="smdp-category-scroll-container">
			<!-- // render the carousel here -->            
                <?php foreach ( $categories as $category ) : 
                    $catData = get_product_category( $category['cat_carousel_cat'] );
                    $iconD = $category['cat_carousel_icon_desktop']['url'];                    
                    $icon = $iconD ? $iconD : $catData['icon'];
                    if ( empty( $catData ) ) {
                        continue;
                    }
                    $title = $category['cat_carousel_title'] !== '' ? $category['cat_carousel_title'] : $catData['name'];
                    // var_dump($data['metas']);
                    ?>
                    <a title="Explore <?= esc_html($catData['name']); ?> category"  class="smdp-category-scroll-item<?= $showIcon==true ? ' with-icon':'' ;?>" href="<?php echo esc_url( $catData['link'] ); ?>" title= rel="noopener noreferrer">
                        <?php if($showIcon):?>
                        <span class="smdp-category-scroll-item-icon lazy-bg"  data-bg="<?= esc_url($icon); ?>" role="img" aria-label="<?= esc_attr($catData['alt'] ?? 'Category Icon'); ?>">
                            </span>
                        <?php endif; ?>
                        <span><?php echo esc_html( $title ); 
                        if($showCounter){
                            $count = $catData['count'] ?? 0;
                            if ( $count > 0 ) {
                            ?>
                            <span class="smdp-category-scroll-item-count">
                                <?php
                                    echo $showIcon==true ? '' : ' - ';
                                    if ( $count > 25 ) {
                                        $count = $count - 5;                                        
                                        echo esc_html__( ($ln== 'bn'?enTobnNumber($count): $count).'+', 'smdp-cat-carousel' );
                                    }else{                                        
                                        echo esc_html( $ln== 'bn'?enTobnNumber($count): $count , 'smdp-cat-carousel' );
                                    } 
                                ?>
                            </span>
                            <?php
                            }
                        }
                        ?></span>
                        
                        
                    </a>
                  
                <?php endforeach; ?> 
                </div>                              
		</section>
        
    <?php
    if($deviceType =='tablet' || $deviceType =='desktop'):
        ?>
        <script>
            jQuery(document).ready(function ($) {
            $(".smdp-category-scroll-container").on("wheel", function (e) {
                e.preventDefault();
                this.scrollLeft += e.originalEvent.deltaY;
            });
            });
        </script>
    <?php endif;
} // End function smdp_cat_car_template().




