<?php
! defined( 'ABSPATH' ) && exit; // Exit if accessed directly
require_once( __DIR__ . '/controls/index.php' );
require_once( __DIR__ . '/template/index.php' );


class carCar_Widget extends \Elementor\Widget_Base {
    private $id = 'smdp_pc'; // widget id prefix
    public function get_name(): string {
		return 'smdp_product_catategories';
	}
    public function get_title(): string {
		return esc_html__( 'Product Categories', 'smdp-cat-carousel' );
	}
    public function get_categories(): array {
		return [ 'general', 'smdp' ];
	}
    public function get_keywords(): array {
		return [ 'catcar', 'smdp catcar', 'category', 'carousel', 'smdp' ];
	}
    public function get_icon(): string {
		return 'eicon-post-slider';
	}
    public function has_widget_inner_wrapper(): bool {
        return false;
    }
    public function get_script_depends(): array {
       return [ 'elementor-frontend','smdp-cat-carousel' ];
    }
    protected function register_controls(): void {
        Controls::general($this,'General',$this->id.'_general','.smdp-category-general');
        Controls::heading($this,'Heading',$this->id.'_heading','.smdp-category-scroll-title');
        Controls::items($this,'Items',$this->id.'_items','.smdp-category-scroll-item');
        Controls::counter($this,'Counter',$this->id.'_counter','.smdp-category-counter');
    }
    protected function render(): void {
        // I want to use the $id in here
        $settings = $this->get_settings_for_display();
        $rawSettings = $this->get_settings();
        $id = $this->id;
        //Templates::posdCat($settings,$id,$rawSettings);
        Templates::dummyhtml($settings,$id,$rawSettings);
    }
}