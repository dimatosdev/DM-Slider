<?php

/**
 * Plugin Name: DM Slider
 * Plugin URI: https://github.com/dimatosdev/dm-slider
 * Description: Plugin para criar um slider de imagens
 * Version: 1.0
 * Requires at least: 5.6
 * Author: Diego de Matos
 * Author URI: https://github.com/dimatosdev
 * License: GPL v2 or later
 * Licence URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: dm-slider
 * Domain Path: /languages
 * */ 

 /*
DM Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

DM Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with DM Slider. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/
 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'DM_Slider' ) ) {
    class DM_Slider {
        public function __construct() {
            $this->define_constants();

            $this->load_textdomain();

            require_once( DM_SLIDER_PATH . 'functions/functions.php' );

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( DM_SLIDER_PATH . 'post-types/class.dm-slider-cpt.php' );
            $DM_Slider_Post_Type = new DM_Slider_Post_Type();

            require_once( DM_SLIDER_PATH . 'class.dm-slider-settings.php' );
            $DM_Slider_Settings = new DM_Slider_Settings();

            require_once( DM_SLIDER_PATH . 'shortcodes/class.dm-slider-shortcode.php' );
            $DM_Slider_Shortcode = new Dm_Slider_Shortcode();

            add_action('wp_enqueue_scripts', array( $this, 'register_scripts' ), 999);

            add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
        }

        public function define_constants(){
            define( 'DM_SLIDER_PATH', plugin_dir_path(__FILE__));
            define( 'DM_SLIDER_URL', plugin_dir_url(__FILE__));
            define( 'DM_SLIDER_VERSION', '1.0.0');
        }

        public static function activate(){
            update_option( 'rewrite_rules', '' );
        }

        public static function deactivate(){
            flush_rewrite_rules();
            unregister_post_type( 'dm-slider' );
        }

        public static function uninstall(){
            $posts = get_posts( 
                array( 
                    'post_type' => 'dm-slider', 
                    'numberposts' => -1, 
                    'post_status' => 'any' 
                    ) 
            );
            foreach( $posts as $post ){
                wp_delete_post( $post->ID, true );
            }
            delete_option( 'dm_slider_options' );
        }

        public function load_textdomain(){
            load_plugin_textdomain( 'dm-slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public function add_menu(){
            add_menu_page( 
                esc_html__('DM Slider Options', 'dm-slider'), 
                esc_html__('DM Slider', 'dm-slider'), 
                'manage_options', 
                'dm-slider-admin', 
                array( $this, 'dm_slider_settings_page' ), 
                'dashicons-images-alt2', 
                
            );

            add_submenu_page(
                'dm-slider-admin',
                esc_html__('Manage Slides', 'dm-slider'),
                esc_html__('Manage Slides', 'dm-slider'),
                'manage_options',
                'edit.php?post_type=dm-slider',
                null,
                null,
            );

            add_submenu_page(
                'dm-slider-admin',
                esc_html__('Add New Slide', 'dm-slider'),
                esc_html__('Add New Slide', 'dm-slider'),
                'manage_options',
                'post-new.php?post_type=dm-slider',
                null,
                null,
            );
        }

        public function dm_slider_settings_page(){
            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }
            if ( ! isset( $_GET['settings-updated'] ) ) {
                add_settings_error( 'dm_slider_options', 'dm_slider_message', esc_html__('Settings Saved', 'dm-slider'), 'success' );
            }
            settings_errors( 'dm_slider_options' );
            
            require( DM_SLIDER_PATH . 'views/settings-page.php' );
        }

        public function register_scripts(){
            wp_register_script( 'dm-slider-main-jq', DM_SLIDER_URL . 'vendor/jquery.flexslider-min.js', array('jquery'), DM_SLIDER_VERSION, true );
           
            wp_register_style( 'dm-slider-main-css', DM_SLIDER_URL . 'vendor/flexslider.css', array(), DM_SLIDER_VERSION, 'all' );
            wp_register_style( 'dm-slider-style-css', DM_SLIDER_URL . 'assets/css/frontend.css', array(), DM_SLIDER_VERSION, 'all' );
        }

        public function register_admin_scripts(){
            global $typenow;
            if( $typenow == 'dm-slider' ){
                wp_enqueue_style( 'dm-slider-admin', DM_SLIDER_URL . 'assets/css/admin.css', array(), DM_SLIDER_VERSION, 'all' );
            }
            
        }
        
    }
}
if ( class_exists( 'DM_Slider' ) ) {
    register_activation_hook( __FILE__, array( 'DM_Slider', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'DM_Slider', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'DM_Slider', 'uninstall' ) );

    $dm_slider = new DM_Slider();
}