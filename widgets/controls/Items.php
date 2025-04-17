<?php 

!defined('ABSPATH') && exit; // Exit if accessed directly

class Items {
    public static function get_product_categories() {
        $args = array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        );
        $categories = get_terms( $args );
        $options = [];
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
            foreach ( $categories as $category ) {
                $options[ $category->term_id ] = $category->name;
            }
        }
        return $options;
        
    }
    public static function get_product_category_name($id){
        $cat = get_product_category($id);
        var_dump($id);
        var_dump($cat);
        if($cat){
            return $cat['name'];
        }
        return $id;
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

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'item_title',  // Changed to more standard name
            [
                'label' => esc_html__('Name', $domain),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category', $domain),
                'placeholder' => esc_html__('Category Title', $domain),
                
            ]
        ); 
        $repeater->add_control(
            'enable_custome_title',
            [
                'label' => esc_html__('Custom Title', $domain),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', $domain),
                'label_off' => esc_html__('No', $domain),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'item_id',  // Changed to more standard name
            [
                'label' => esc_html__('Select Category', $domain),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => self::get_product_categories(),
                'label_block' => true,
                'default' => '',
                'frontend_available' => true,
            ]
        ); 
        
        $repeater->add_responsive_control(
            'item_icon',  // Changed to more standard name
            [
                'label' => esc_html__('Icon', $domain),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => false,
                
            ]
        );      
        $obj->add_control(
            $secId.'_categories',  // Fixed typo (was _categoriez)
            [
                'label' => esc_html__('Categories', $domain),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),                
                'title_field' => '{{{ item_title || "Category #" + item_id }}}',

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
            $secId.'_style_align',
                    
            [
                'label' => esc_html__( 'Item Align', $domain ),
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