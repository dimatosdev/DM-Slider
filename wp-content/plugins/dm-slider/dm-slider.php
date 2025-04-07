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

            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( DM_SLIDER_PATH . 'post-types/class.dm-slider-cpt.php' );
            $DM_Slider_Post_Type = new DM_Slider_Post_Type();
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

        }

        public function add_menu(){
            add_menu_page( 
                'DM Slider Options', 
                'DM Slider', 
                'manage_options', 
                'dm-slider-admin', 
                array( $this, 'dm_slider_settings_page' ), 
                'dashicons-images-alt2', 
                
            );

            add_submenu_page(
                'dm-slider-admin',
                'Manage Slides',
                'Manage Slides',
                'manage_options',
                'edit.php?post_type=dm-slider',
                null,
                null,
            );

            add_submenu_page(
                'dm-slider-admin',
                'Add New Slide',
                'Add New Slide',
                'manage_options',
                'post-new.php?post_type=dm-slider',
                null,
                null,
            );
        }

        public function dm_slider_settings_page(){
            echo "This is a settings page for DM Slider";
        }
        
    }
}
if ( class_exists( 'DM_Slider' ) ) {
    register_activation_hook( __FILE__, array( 'DM_Slider', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'DM_Slider', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'DM_Slider', 'uninstall' ) );

    $dm_slider = new DM_Slider();
}