<?php 

if(!defined('ABSPATH')){
    exit; // Exit if accessed directly
}

class Heading {
    public static function heading($obj,$label='Section Label',$secId='section_id',$selector='.smdp-category-scroll-title',$domain='smdp-cat-carousel'){
$obj->start_controls_section(
            $secId.'_content',
            [
                'label' => esc_html__( $label, $domain ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $obj->add_control(
            $secId.'_text',
            [
                'label' => esc_html__('Text', $domain ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'জনপ্রিয় প্রোডাক্ট ক্যাটাগরি সমূহঃ', $domain ),
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your Heading', $domain ),
            ]
        );
        $obj->add_control(
			$secId.'_visibility',
			[
				'label' => esc_html__( $label.' Visible', $domain ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', $domain ),
				'label_off' => esc_html__( 'No', $domain ),
				'return_value' => 'yes',
				'default' => 'yes',
                'description' => esc_html__( 'Show or hide the heading.', $domain ),
			]
		);
        $obj->add_responsive_control(
			$secId.'_align',
            // convert to bangla number
			[
				'label' => esc_html__( 'Alignment', $domain ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', $domain ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', $domain ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', $domain ),
						'icon' => 'eicon-text-align-right',
					],
                ],
                'toggle' => true,
                'default' => 'center',
                'selectors' => [
					'{{WRAPPER}} '.$selector => 'text-align: {{VALUE}};',
				],
			]
		);
        $obj->end_controls_section();
        //------------------------------------------------------------------------------------------------
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
                'fields_options' => [
                    'font_size' => [
                        'default' => [
                            'unit' => 'rem',
                            'size' => 1.2
                        ],
                        'size_units' => ['px', 'em', 'rem',],
                    ],
                    'font_weight' => [
                        'default' => '600',
                    ],
                ],
			]
		);
        
        
        $obj->add_responsive_control( // Margin
			$secId.'_padding',
			[
				'label' => esc_html__( 'Padding', $domain ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem'],
				'default' => [
                    'unit' => 'rem',
					'isLinked' => false,
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
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} '.$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $obj->add_responsive_control( // Margin
			$secId.'_margin',
			[
				'label' => esc_html__( 'Margin', $domain ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem'],
				'default' => [
					'bottom' => 0.25,
					'unit' => 'rem',
					'isLinked' => false,
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
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
				'selectors' => [
					'{{WRAPPER}} '.$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $obj->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$selector,
                'separator' => 'before',
                'label' => esc_html__( 'Background', $domain ),
                'description' => esc_html__( 'Add a background to the element.', $domain ),

			]
		);
        $obj->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[

				'name' => $secId.'_border',
                'separator' => 'before',
				'selector' => '{{WRAPPER}} '.$selector,
                
			]
		);
        $obj->add_control(
            $secId.'_border_radius',
            [
                'label' => esc_html__( 'Border Radius', $domain ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem'],
                'default' => [
                    'unit' => 'px',
                    'isLinked' => false,

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
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} '.$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $obj->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} '.$selector,
                'separator' => 'before',
                'label' => esc_html__( 'Box Shadow', $domain ),
                'description' => esc_html__( 'Add a shadow effect to the element.', $domain ),
			]
		);
        $obj->end_controls_section();
    }

}