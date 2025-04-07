<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class SmdP_carCar_Widget extends \Elementor\Widget_Base {
	 
	
	public function get_name(): string {
		return 'CAT_Carousel';
	}

    public function get_style_depends(): array {
		return [ 'smdp-cat-carousel' ];
	}
    public function get_script_depends(): array {
        return [ 'smdp-cat-carousel' ];
    }
	// Get widget title.
	 
	public function get_title(): string {
		return esc_html__( 'CAT Carousel', 'smdp-cat-carousel' );
	}

	// Get widget icon.
	public function get_icon(): string {
		return 'eicon-slider-previous';
	}

	// Get widget categories.
	
	public function get_categories(): array {
		return [ 'general', 'smdp' ];
	}

	// Get widget keywords.

	public function get_keywords(): array {
		return [ 'catcar', 'smdp catcar', 'category', 'carousel', 'smdp' ];
	}

	// Get custom help URL.

	public function get_custom_help_url(): string {
		return 'https://developers.elementor.com/docs/widgets/';
	}

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
public static function get_product_category($id) {
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

	/**
	 * Register carousel widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls(): void {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'smdp-cat-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'smdp_section_title',
            [
                'label' => esc_html__( 'Section Title', 'smdp-cat-carousel' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Categories', 'smdp-cat-carousel' ),
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your title', 'smdp-cat-carousel' ),
                'separator' => 'after',
                
            ]
        );
        $this->add_control(
			'categories',
            [
                'label' => esc_html__( 'Categories', 'smdp-cat-carousel' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'cat_carousel_cat',
                        'label' => esc_html__( 'Select Category', 'smdp-cat-carousel' ),
                        'type' => \Elementor\Controls_Manager::SELECT2,
                        'options' => self::get_product_categories(),
                        'label_block' => true,                        
                        'default' => '',
                    ],
                    [
                        'name' => 'cat_carousel_title',
                        'label' => esc_html__( 'Title', 'smdp-cat-carousel' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( '', 'smdp-cat-carousel' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'cat_carousel_icon_desktop',
                        'label' => esc_html__( 'Icon Desktop', 'smdp-cat-carousel' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'label_block' => true,
                        'default' => [
                            'id' => '',
                            'url' => '',
                        ]
                    ],
                    
                    
                ],
                'title_field' => '{{{ cat_carousel_cat}}}',
                'selector' => 'cat_carousel_cat',
            ]
		);
        
        $this->add_responsive_control(
			'smdp_show_icon',
			[
				'label' => esc_html__( 'Show Icon', 'smdp-cat-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'smdp-cat-carousel' ),
				'label_off' => esc_html__( 'Hide', 'smdp-cat-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'prefix_class' => 'icon-view-%s',
			]
		);

		$this->end_controls_section();
        
        
        

        $this->start_controls_section(
			'counter_section',
			[
				'label' => esc_html__( 'Counter', 'smdp-cat-carousel' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
			'show_counter',
			[
				'label' => esc_html__( 'Show Counter', 'smdp-cat-carousel' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'smdp-cat-carousel' ),
				'label_off' => esc_html__( 'Hide', 'smdp-cat-carousel' ),
				'return_value' => 'yes',
				'default' => 'yes',
                
			]
		);
        $this->add_control(
			'smdp_counter_lng',
            // convert to bangla number
			[
				'label' => esc_html__( 'Choose Language', 'smdp-cat-carousel' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'en' => [
						'title' => esc_html__( 'English', 'textdomain' ),
						'icon' => 'eicon-upgrade-crown',
					],
					'bn' => [
						'title' => esc_html__( 'Bangla', 'textdomain' ),
						'icon' => 'eicon-notification',
					],
                ],
                'toggle' => true,
                'default' => 'en',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Style', 'smdp-cat-carousel' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'carousel_style',
            [
                'label' => esc_html__( 'Carousel Style', 'smdp-cat-carousel' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'smdp-cat-carousel' ),
                    'custom' => esc_html__( 'Custom', 'smdp-cat-carousel' ),
                ],
                'default' => 'default',
            ]
        );
        $this->add_control(
            'carousel_speed',
            [
                'label' => esc_html__( 'Carousel Speed', 'smdp-cat-carousel' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 500,
                'min' => 100,
                'max' => 5000,
                'step' => 100,
            ]
        );
        $this->add_control(
			'color',
			[
				'label' => esc_html__( 'Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'inherit',
				'selectors' => [
					'{{WRAPPER}} h3' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
            'car_car_shadow',
            [
                'label' => esc_html__( 'Carousel Shadow', 'smdp-cat-carousel' ),
                'type' => \Elementor\Controls_Manager::BOX_SHADOW,
                'selector' => '{{WRAPPER}} .smdp-catcar-carousel',
                'default' => [
                    'color' => 'rgba(28, 31, 35, .1)',
                    'position_x' => 0,
                    'position_y' => 4,
                    'blur' => 24,
                    'spread' => 0,
                    'size' => 0,
                ],
                'separator' => 'before',
            ]
            );

        $this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render(): void {
		$settings = $this->get_settings_for_display();
        $rawSettings = $this->get_settings();

        $cats = $settings['categories'];
        if ( empty( $cats ) ) {
            return;
        }
        $showCounter = $settings['show_counter'] === 'yes' ? true : false;
        $ln = $settings['smdp_counter_lng'];
        $showIcon = $settings['smdp_show_icon'] === 'yes' ? true : false;
        $deviceType = getDeviceType();
        $postFix = $deviceType == 'desktop' ? 'smdp_show_icon' : 'smdp_show_icon_'.$deviceType;
        $showIcon = $settings[$postFix] === 'yes' ? true : false;        
        
        $sec_title = $settings['smdp_section_title'] !== '' ? $settings['smdp_section_title'] : esc_html__( 'Categories', 'smdp-cat-carousel' );
        
        //dumper($settings);
       

		?>
		<section class="smdp-category-scroll" data-device="<?php echo esc_attr( $deviceType ); ?>" >   
            <div class="woodmart-title-container title wd-fontsize-m"><?= esc_html($sec_title); ?></div> 
            <div class="smdp-category-scroll-container">
			<!-- // render the carousel here -->            
                <?php foreach ( $settings['categories'] as $category ) : 
                    $data = self::get_product_category( $category['cat_carousel_cat'] );
                    $iconD = $category['cat_carousel_icon_desktop']['url'];                    
                    $icon = $iconD ? $iconD : $data['icon'];
                    if ( empty( $data ) ) {
                        continue;
                    }
                    $title = $category['cat_carousel_title'] !== '' ? $category['cat_carousel_title'] : $data['name'];
                    // var_dump($data['metas']);
                    ?>
                    <a title="Explore <?= esc_html($data['name']); ?> category"  class="smdp-category-scroll-item<?= $showIcon==true ? ' with-icon':'' ;?>" href="<?php echo esc_url( $data['link'] ); ?>" title= rel="noopener noreferrer">
                        <?php if($showIcon):?>
                        <span class="smdp-category-scroll-item-icon lazy-bg"  data-bg="<?= esc_url($icon); ?>" role="img" aria-label="<?= esc_attr($data['alt'] ?? 'Category Icon'); ?>">
                            </span>
                        <?php endif; ?>
                        <span><?php echo esc_html( $title ); 
                        if($showCounter){
                            $count = $data['count'] ?? 0;
                            if ( $count > 0 ) {
                            ?>
                            <span class="smdp-category-scroll-item-count clamp-1">
                                <?php
                                    
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
    <?php endif;?>


<style>






.scroll-item:hover {
  background: #ddd;
}


</style>
       
		<?php
	}

}

