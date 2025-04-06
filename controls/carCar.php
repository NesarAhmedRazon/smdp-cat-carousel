<?php 


class SmdP_carCar_Control extends \Elementor\Base_Control {

	public function get_type(): string {
        return 'carCar';
    }

	public function content_template(): void {
        ?>
        <div class="car-car-control">
            <label><?php esc_html_e( 'Car Car Control', 'smdp-cat-carousel' ); ?></label>
            <input type="text" class="car-car-input" />
        </div>
        <?php
    }

}