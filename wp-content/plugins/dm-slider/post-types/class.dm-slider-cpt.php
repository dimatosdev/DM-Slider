<?php

if ( ! class_exists('DM_Slider_Post_Type') ) {
    class DM_Slider_Post_Type {
        public function __construct() {
            add_action( 'init', array( $this, 'create_post_type' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
        }
        public function create_post_type() {
            register_post_type( 'dm-slider', array(
                'label' => 'DM Slider',
                'description' => 'DM Slider',
                'labels' => array(
                    'name' => 'DM Sliders',
                    'singular_name' => 'DM Slider'
                ),
                'public' => true,
                'supports' => array( 'title', 'editor', 'thumbnail' ),
                'hierarchical' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'can_export' => true,
                'has_archive' => false,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-images-alt2',
                //'register_meta_box_cb' => array( $this, 'add_meta_boxes' ),
            ) );
        }

        public function add_meta_boxes() {
            add_meta_box(
                'dm_slider_meta_box',
                'DM Slider Options',
                array( $this, 'add_inner_meta_boxes' ),
                'dm-slider',
                'normal',
                'high'
            );
        }

        public function add_inner_meta_boxes( $post ) {
            require_once( DM_SLIDER_PATH . 'views/dm-slider-metabox.php' );
        }

        public function save_post( $post_id ) {
            if( isset( $_POST['action'] ) && $_POST['action'] == 'editpost' ) {
                $link_text = sanitize_text_field( $_POST['dm-slider-link-text'] );
                update_post_meta( $post_id, 'dm-slider-link-text', $link_text );
            }
        }
    }    

}