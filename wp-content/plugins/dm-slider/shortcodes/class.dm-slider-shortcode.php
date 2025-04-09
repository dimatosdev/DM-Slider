<?php

if ( !class_exists( 'Dm_Slider_Shortcode' ) ) {
    class Dm_Slider_Shortcode {
        public function __construct() {
            add_shortcode( 'dm_slider', array( $this, 'render_shortcode' ) );
        }

        public function render_shortcode( $atts = array(), $content = null, $tag = '' ) {

            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            extract ( shortcode_atts(
                array(
                    'id' => '',
                    'orderby' => 'date',
                ),
                $atts,
                $tag
            ));

            if ( !empty( $id ) ) {
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            ob_start();

            require( DM_SLIDER_PATH . 'views/dm-slider-shortcode.php' );

            wp_enqueue_script( 'dm-slider-main-jq' );
            wp_enqueue_style( 'dm-slider-main-css' );
            wp_enqueue_style( 'dm-slider-style-css' );
            dm_slider_options();
            
            return ob_get_clean();
        }
    }
}