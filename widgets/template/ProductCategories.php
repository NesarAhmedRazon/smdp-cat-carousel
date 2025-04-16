<?php 
!defined('ABSPATH') && exit; // Exit if accessed directly

class ProductCategories {
    public static function html($settings,$id,$rawSettings=[],$domain='smdp-cat-carousel'){
        if( !is_array($settings)) {
            return;
        }
        $hid = $id.'_heading';
        $deviceType = getDeviceType();
        $headingVisible = $settings[$hid.'_visibility'] === 'yes' ? true : false;
        $sec_title = $settings[$hid.'_text'] !== '' ? $settings[$hid.'_text'] : esc_html__( 'Categories', 'smdp-cat-carousel' );

        //-----------------
        $cid =  $id.'_items';
        $categories = $settings[$cid.'_categories'];
        $showIcon = $settings[$cid.'_show_icon'] === 'yes' ? true : false;
        $postFix = $deviceType == 'desktop' ? $cid.'_show_icon' : $cid.'_show_icon_'.$deviceType;

        // --------- Counter info
        $xid =  $id.'_counter';
        $showCounter = $settings[$xid.'_visibility'] === 'yes' ? true : false;
        $ln = $settings[$xid.'_language'];

        ?>
            <section class="smdp-category-scroll" data-device="<?php echo esc_attr( $deviceType ); ?>" >
                <?php if($headingVisible):?>  
                    <div class="smdp-category-scroll-title"><?= esc_html($sec_title); ?></div> 
                <?php endif; ?>
                <div class="smdp-category-scroll-container">
                    <?php foreach ( $categories as $category ) : 
                        $catID = $category['item_id'];   
                        if( empty($catID) ) {
                            continue;
                        }

                        $catData = get_product_category( $catID );
                        if ( empty( $catData ) ) {
                            continue;
                        }
                        $iconD = $category['item_icon']['url'];
                        $iconT= isset($category['item_icon_tablet']) ? $category['item_icon_tablet']['url'] : null; 
                        $iconM= isset($category['item_icon_mobile']) ? $category['item_icon_mobile']['url'] : null;                         
                        $icon = $iconD ? $iconD : $catData['icon']; 

                        // Category Title
                        $title = $category['item_title'] !== '' ? $category['item_title'] : $catData['name'];
                        
                        ?>
                        <a title="Explore <?= esc_html($catData['name']); ?> category"  class="smdp-category-scroll-item<?= $showIcon==true ? ' with-icon':'' ;?>" href="<?php echo esc_url( $catData['link'] ); ?>" title= rel="noopener noreferrer">
                        <?php if($showIcon):?>
                            <span class="smdp-category-scroll-item-icon lazy-bg"  data-bg="<?= esc_url($icon).'"';  $iconT? ' data-bgT="'.esc_url($iconT).'"':''; $iconM? ' data-bgT="'.esc_url($iconM).'"':'';?> role="img" aria-label="<?= esc_attr($catData['alt'] ?? 'Category Icon'); ?>">
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
                            <?php }} ?>
                        </span> 
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php if($deviceType =='tablet' || $deviceType =='desktop'): ?>
            <script>
                jQuery(document).ready(function ($) {
                $(".smdp-category-scroll-container").on("wheel", function (e) {
                    e.preventDefault();
                    this.scrollLeft += e.originalEvent.deltaY;
                });
                });
            </script>
            <?php endif;
        
    }
}