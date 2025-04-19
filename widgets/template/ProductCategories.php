<?php 
!defined('ABSPATH') && exit; // Exit if accessed directly

class ProductCategories {
    public static function dummyhtml($settings,$id,$rawSettings=[],$domain='smdp-cat-carousel'){
        if( !is_array($settings)) {
            return;
        }
        $deviceType = getDeviceType();
        $gid = $id.'_general';
        $heading = $settings[$gid.'_heading'];
        $type = $settings[$gid.'_hiararcy'];
        $icon = $settings[$gid.'_icon_visibility'] == 'on' ? true : false;
        $counter = $settings[$gid.'_counter_visibility'] == 'on' ? true : false;
        // ------------------------------------
        
        $cid =  $id.'_items';
        $categories = $type == 'all' ? $settings[$cid.'_categories'] : $settings[$cid.'_categories2'] ;

        ?>
            <section class="smdp-category-scroll" data-device="<?= esc_attr( $deviceType ); ?>" >
                <?php if(!$heading==""):?>  
                    <div class="smdp-category-scroll-title"><?= esc_html($heading); ?></div> 
                <?php endif; ?>
                <div class="smdp-category-scroll-container">
                <?php if(!empty($categories)):?>  
                    
                    <?php foreach ( $categories as $category ) : 
                        $id = $category['nested_categories'];  
                        $data = get_product_category( $id );
                        if ( empty( $data ) ) {
                            continue;
                        }
                         $title = $category['item_title'] !== '' ? $category['item_title'] : $data['name'];
                        
                        ?>
                        <a 
                            title="Explore <?= esc_html($title); ?> category"  
                            class="smdp-category-scroll-item<?= $icon==true ? ' with-icon':'' ;?>" 
                            href="<?= esc_url( $data['link'] ); ?>" 
                            title= rel="noopener noreferrer">
                            <?php if($icon){
                                $iconSrcD = $category['item_icon']['url'];
                                $iconSrcT= isset($category['item_icon_tablet']) ? $category['item_icon_tablet']['url'] : ''; 
                                $iconSrcM= isset($category['item_icon_mobile']) ? $category['item_icon_mobile']['url'] : '';
                                $iconSrc = $iconSrcD ? $iconSrcD : $data['icon']; 
                                ?>
                            <span class="smdp-category-scroll-item-icon lazy-bg" data-bg="<?= esc_url($iconSrc);?>" data-bgt="<?= esc_url($iconSrcT);?>" data-bgm="<?= esc_url($iconSrcM);?>" role="img" aria-label="<?= esc_attr($data['alt'] ?? 'Category Icon'); ?>"></span>
                            
                        <?php } 
                           
                        ?>
                            <span class="smdp-category-scroll-item-title" >
                                <?= esc_html( $title ); ?>
                                <?php                                     
                                    if($counter):
                                        $count = $data['count'] ?? 0;
                                        $ln = isset($settings[$gid.'_counter_language']) ? $settings[$gid.'_counter_language'] : 'en';
                                        if ( $count > 0 ) : ?>
                                        <span class="smdp-category-scroll-item-count">
                                            <?php
                                                echo $icon==true ? '' : ' - ';
                                                if ( $count > 25 ) {
                                                    $count = $count - 5;                                        
                                                    echo esc_html__( ($ln== 'bn'?enTobnNumber($count): $count).'+', 'smdp-cat-carousel' );
                                                }else{                                        
                                                    echo esc_html( $ln== 'bn'?enTobnNumber($count): $count , 'smdp-cat-carousel' );
                                                } 
                                            ?>
                                        </span>
                                        <?php endif;
                                    endif;
                                ?>
                            </span>
                        </a>
                    <?php endforeach; ?>

                <?php else : ?>
                    Please select category
                <?php endif; ?>
                    </div>
            </section>
        <?php
    }
    public static function html($settings,$id,$rawSettings=[],$domain='smdp-cat-carousel'){
        if( !is_array($settings)) {
            return;
        }

        // ------------ General settings
        $gid = $id.'_general';
        $type = isset($settings[$gid.'_hiararcy']) ? $settings[$gid.'_hiararcy']: 'all';
    
        $hid = $id.'_heading';
        $deviceType = getDeviceType();
        $headingVisible = $settings[$hid.'_visibility'] === 'yes' ? true : false;
        $sec_title = $settings[$hid.'_text'] !== '' ? $settings[$hid.'_text'] : esc_html__( 'Categories', 'smdp-cat-carousel' );

        //-----------------
        $cid =  $id.'_items';
        
        $catItem = $type == 'all' ? $cid.'_categories' : $cid.'_categories2' ;
        $categories = $settings[$catItem] ;
        $showIcon = false;
        
        $postFix = $deviceType == 'desktop' ? $cid.'_show_icon' : $cid.'_show_icon_'.$deviceType;
        
        // --------- Counter info
        $xid =  $id.'_counter';
        $showCounter = isset($settings[$xid.'_visibility']) === 'yes' ? true : false;
        $ln = isset($settings[$xid.'_language'])?$settings[$xid.'_language']:'en';
        //var_dump($categories);
        ?>
            <section class="smdp-category-scroll" data-device="<?php echo esc_attr( $deviceType ); ?>" >
                <?php if($headingVisible):?>  
                    <div class="smdp-category-scroll-title"><?= esc_html($sec_title); ?></div> 
                <?php endif; ?>
                <div class="smdp-category-scroll-container">
                    <?php foreach ( $categories as $category ) :
                         
                        $catID = $category['nested_categories'];   
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