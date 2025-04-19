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
				'label' => esc_html__( 'Category Hierarchy', $domain ),
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
        
        
        
        
        $obj->add_control(
            $secId.'_heading',
            [
                'label' => esc_html__('Text', $domain ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'জনপ্রিয় প্রোডাক্ট ক্যাটাগরি সমূহঃ', $domain ),
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your Heading', $domain ),
            ]
        );
        $obj->add_responsive_control(
            $secId.'_icon_visibility',
            [
                'label' => esc_html__('Icon', $domain),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', $domain),
                'label_off' => esc_html__('Off', $domain),
                'return_value' => 'on',
                'default' => 'on',
                'frontend_available' => true,
                
            ]
        );
        $obj->add_responsive_control(
            $secId.'_counter_visibility',
            [
                'label' => esc_html__('Product Count', $domain),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', $domain),
                'label_off' => esc_html__('Off', $domain),
                'return_value' => 'on',
                'default' => 'on',
            ]
        );
        $obj->add_control(
			$secId.'_counter_language',
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
        $obj->add_responsive_control(
			$secId.'_style_display',
            // convert to bangla number
			[
				'label' => esc_html__( 'Style', $domain ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'grid' => [
						'title' => esc_html__( 'Grid', $domain ),
						'icon' => 'eicon-container-grid',
					],
					'flex' => [
						'title' => esc_html__( 'Flex', $domain ),
						'icon' => 'eicon-gallery-justified',
					],
                ],                
                'default' => 'flex',
                'selectors' => [
                    '{{WRAPPER}} .smdp-category-scroll-container' => '--smdp-pc-display: {{VALUE}};',
                ],
			]
		);
        
        $obj->add_responsive_control(
            $secId.'_style_grid_column',
            [
                'label' => esc_html__( 'Grid Columns', $domain ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'fr', 'custom' ],                 
                'separator' => 'before',              
                'default' => [
                    'unit' => 'fr',
                    'size' => 9,
                ],
                'tablet_default' => [
                    'unit' => 'fr',
                    'size' => 4,
                ],
                'mobile_default' => [
                    'unit' => 'fr',
                    'size' => 3,
                ],
                'range' => [
                    'fr' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .smdp-category-scroll-container' => '--smdp-pc-cols:{{SIZE}};',
                ],
                'condition' => [
                    $secId.'_style_display' => 'grid',
                ],
            ]
            
        );
        $obj->add_responsive_control(
            $secId.'_style_grid_gap',
            [
                'label' => esc_html__( 'Gaps', 'elementor' ),
                'type' => \Elementor\Controls_Manager::GAPS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'unit' => 'rem',
                    'size' => '.5'
                ],
                'selectors' => [
                    '{{WRAPPER}} .smdp-category-scroll-container' => '--smdp-pc-gap: {{ROW}}{{UNIT}} {{COLUMN}}{{UNIT}};--smdp-pc-row-gap: {{ROW}}{{UNIT}};--smdp-pc-column-gap: {{COLUMN}}{{UNIT}};',
                ],
                'validators' => [
                    'Number' => [
                        'min' => 0,
                    ],
                ],
                'condition' => [
                    $secId.'_style_display' => 'grid',
                ],
            ]
        
        );
        //---------------Flex display-----------
        $obj->add_responsive_control(
            $secId.'_style_flex_wrap',
                    
            [
                'label' => esc_html__( 'Item Wraping', $domain ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'wrap' => [
                        'title' => esc_html__( 'Wrap', $domain),
                        'icon' => 'eicon-wrap',
                    ],
                    'nowrap' => [
                        'title' => esc_html__( 'No Wrap', $domain),
                        'icon' => 'eicon-nowrap',
                    ],
                ],
                'condition' => [
                    $secId.'_style_display' => 'flex',
                ],
                'default' => 'wrap',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .smdp-category-scroll-container' => '--smdp-pc-flex-wrap: {{VALUE}};',
                ],
            ]
        );
        $obj->add_responsive_control(
            $secId.'_style_flex_align',
                    
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
                'default' => 'center',
                'label_block' => true,
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .smdp-category-scroll-container' => '--smdp-pc-justify-content: {{VALUE}};',
                ],
                'condition' => [
                    $secId.'_style_display' => 'flex',
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