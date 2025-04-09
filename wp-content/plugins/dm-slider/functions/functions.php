<?php
if ( ! function_exists( 'dm_slider_get_pladeholder_image' ) ) {
    function dm_slider_get_pladeholder_image() {
        return '<img src="' . esc_url(DM_SLIDER_URL . 'assets/images/default.jpg') . '" alt="Default Image" class="img-fluid wp-post-image" />';
    }   
}

if ( ! function_exists( 'dm_slider_options' ) ) {
    function dm_slider_options(){
        $show_bullets = isset( DM_Slider_Settings::$options['dm_slider_bullets'] ) && DM_Slider_Settings::$options['dm_slider_bullets'] == 1 ? true : false;

        wp_enqueue_script( 'dm-slider-options-js', DM_SLIDER_URL . 'vendor/flexslider.js', array('jquery'), DM_SLIDER_VERSION, true );

        wp_localize_script( 'dm-slider-options-js', 'SLIDER_OPTIONS', array(
            'controlNav' => $show_bullets
        ) );
    }
}