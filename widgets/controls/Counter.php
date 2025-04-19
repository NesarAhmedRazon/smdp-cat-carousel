<?php 

!defined('ABSPATH') && exit; // Exit if accessed directly

class Counter {
    
    
    public static function controls($obj, $label, $secId, $selector='.smdp-category-scroll-content', $domain='smdp-cat-carousel') {
        
        $obj->start_controls_section(
            $secId.'_style',
            [
                'label' => esc_html__( $label, $domain ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                
            ]
        );
        $obj->add_group_control( // Typography
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => $secId.'_typography',
				'selector' => '{{WRAPPER}} '.$selector,
			]
		);
        
        $obj->end_controls_section();
    }
}