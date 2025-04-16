<?php 

!defined('ABSPATH') && exit; // Exit if accessed directly

class Counter {
    
    
    public static function controls($obj, $label, $secId, $selector='.smdp-category-scroll-content', $domain='smdp-cat-carousel') {
        $obj->start_controls_section(
            $secId.'_section',
            [
                'label' => esc_html__($label, $domain),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $obj->add_responsive_control(
            $secId.'_visibility',
            [
                'label' => esc_html__('Counter On Category', $domain),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', $domain),
                'label_off' => esc_html__('Hide', $domain),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $obj->add_control(
			$secId.'_language',
            // convert to bangla number
			[
				'label' => esc_html__( 'Choose Language', $domain ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'en' => [
						'title' => esc_html__( 'English', $domain ),
						'icon' => 'eicon-upgrade-crown',
					],
					'bn' => [
						'title' => esc_html__( 'Bangla', $domain ),
						'icon' => 'eicon-notification',
					],
                ],
                'toggle' => true,
                'default' => 'en',
			]
		);
        $obj->end_controls_section();

        // --------------------------------------------------------------------------------------
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