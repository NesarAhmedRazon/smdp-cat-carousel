<?php 

!defined('ABSPATH') && exit; // Exit if accessed directly

class Items {

    public static function get_default_categories($type='all') {
        $categories = SMDP_Category_Helper::get_hierarchical_categories($type);
        
        $options = array_map(function ($item) {
                    return [
                        'item_title' => $item['name'],
                        'nested_categories' => $item['id'],
                        'item_icon'=>[
                            'url'=>$item['icon'],
                        ]
                    ];
                }, $categories);
        
        return $options;
        
    }
    
    public static function controls($obj, $label, $secId, $selector='.smdp-category-scroll-content', $domain='smdp-cat-carousel') {
        
        $obj->start_controls_section(
            $secId.'_item_section',
            [
                'label' => esc_html__($label, $domain),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $obj->add_responsive_control(
            $secId.'_show_icon',
            [
                'label' => esc_html__('Show Icon', $domain),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', $domain),
                'label_off' => esc_html__('Hide', $domain),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
                
            ]
        );
  
        $repeater = self::get_standard_repeater($domain);  
        $repeater2 = self::get_standard_repeater($domain,'parent_only'); 
        $obj->add_control(
            $secId.'_categories',  // Fixed typo (was _categoriez)
            [
                'label' => esc_html__('Categories', $domain),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),                
                'title_field' => '{{{ item_title || "Category #" + item_id }}}',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'smdp_pc_general_hiararcy',
                            'operator' => '===',
                            'value' => 'all',
                        ],
                    ],
                ],
            ]
        );      
        $obj->add_control(
            $secId.'_categories2',  // Fixed typo (was _categoriez)
            [
                'label' => esc_html__('Categories2', $domain),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater2->get_controls(),                
                'title_field' => '{{{ item_title || "Category #" + item_id }}}',
                'default' => self::get_default_categories('parent_only'),
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'smdp_pc_general_hiararcy',
                            'operator' => '===',
                            'value' => 'parent_only',
                        ],
                    ],
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
    public static function get_standard_repeater($domain,$type='all') {
    $repeater = new \Elementor\Repeater();

    // Item Title Control
    $repeater->add_control(
        'item_title',
        [
            'label' => esc_html__('Name', $domain),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Category', $domain),
            'placeholder' => esc_html__('Category Title', $domain),
        ]
    );

    // Custom Title Switcher
    $repeater->add_control(
        'enable_custom_title',
        [
            'label' => esc_html__('Custom Title', $domain),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', $domain),
            'label_off' => esc_html__('No', $domain),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );

    // Nested Categories Control
    $repeater->add_control(
        'nested_categories',
        [
            'label' => esc_html__('Select a Category', $domain),
            'type' => 'nested_select2',
            'nested_data' => SMDP_Category_Helper::get_hierarchical_categories($type),
            'select2options' => [
                'placeholder' => 'Select an option',
                'dropdownCssClass' => 'smdp-select2',
                'selectionCssClass' => 'smdp-select2-selection',
                'containerCssClass' => 'smdp-select2-selection'
            ],
            'label_block' => true,
            'description' => esc_html__('Select categories with nested hierarchy', $domain),
        ]
    );

    // Item Icon Control
    $repeater->add_responsive_control(
        'item_icon',
        [
            'label' => esc_html__('Custom Icon', $domain),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'label_block' => false,
        ]
    );

    return $repeater;
}

}

