<?php 

!defined('ABSPATH') && exit; // Exit if accessed directly

class General {

    
    public static function controls($obj, $label, $secId, $selector='.smdp-category-scroll-content', $domain='smdp-cat-carousel') {
        $obj->start_controls_section(
            $secId.'_item_section',
            [
                'label' => esc_html__($label, $domain),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $obj->add_control(
			$secId.'_hiararcy',
            // convert to bangla number
			[
				'label' => esc_html__( 'Category Hierarchy '.$secId.'_hiararcy', $domain ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'parent_only' => [
						'title' => esc_html__( 'Only Parent', $domain ),
						'icon' => 'eicon-post-list',

					],
					'all' => [
						'title' => esc_html__( 'All', $domain ),
						'icon' => 'eicon-sitemap',
					],
                ],
                'toggle' => true,
                'default' => 'all',
                
			]
		);
        $obj->add_responsive_control(
            $secId.'_style_align',
                    
            [
                'label' => esc_html__( 'Items Align', $domain ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', $domain),
                        'icon' => 'eicon-align-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', $domain),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', $domain),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', $domain),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__( 'Space Around', $domain),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'space-evenly' => [
                        'title' => esc_html__( 'Space Evenly', $domain),
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],
                ],
                'devices' => [ 'desktop', 'tablet' ],
                'default' => 'center',
                'label_block' => true,
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .smdp-category-scroll-container' => 'justify-content: {{VALUE}};',
                ],
                
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
        
        $obj->add_responsive_control(
            $secId.'_style_gap',
            [
                'label' => esc_html__( 'Mobile Item Gap', $domain ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'rem','px', '%', 'em' ],
                'devices' => [ 'mobile' ],
                
                'mobile_default' => [
					'size' => 0.5,
                    'unit' => 'rem',
				],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .smdp-category-scroll-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
            
        );
        $obj->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => $secId.'_style_box_shadow',
                'separator' => 'before',
				'selector' => '{{WRAPPER}} .smdp-category-scroll-item',
                'label' => esc_html__( 'Carousel Shadow',  $domain ),
                'default' => [
                    'color' => 'rgba(28, 31, 35, .1)',
                    'position_x' => 0,
                    'position_y' => 4,
                    'blur' => 24,
                    'spread' => 0,
                    'size' => 0,
                ],
                'label_block' => true,
			]
		);
        
        $obj->end_controls_section();
    }
}