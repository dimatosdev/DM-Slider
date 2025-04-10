<?php

if ( ! class_exists( 'DM_Slider_Settings' ) ) {
    class DM_Slider_Settings {
        public static $options;

        public function __construct() {
            self::$options = get_option( 'dm_slider_options' );
            add_action( 'admin_init', array( $this, 'admin_init' ) );
        }

        public function admin_init() {

            register_setting('dm_slider_group', 'dm_slider_options', array($this, 'dm_slider_validate'));
            
            add_settings_section(
                'dm_slider_main_section',
                esc_html__('How does it work?', 'dm-slider'),
                null,
                'dm-slider-page1'
            );

            add_settings_section(
                'dm_slider_second_section',
                esc_html__('Other plugin Options', 'dm-slider'),
                null,
                'dm-slider-page2'
            );

            add_settings_field(
                'dm_slider_shortcode',
                esc_html__('Shortcode', 'dm-slider1'),
                array( $this, 'dm_slider_shortcode_callback' ),
                'dm-slider-page1',
                'dm_slider_main_section'
            );

            add_settings_field(
                'dm_slider_title',
                esc_html__('Slider Title', 'dm-slider'),
                array( $this, 'dm_slider_title_callback' ),
                'dm-slider-page2',
                'dm_slider_second_section',
                array(
                    'label_for' => 'dm_slider_title'
                )
            );

            add_settings_field(
                'dm_slider_bullets',
                esc_html__('Display Bullets', 'dm-slider'),
                array( $this, 'dm_slider_bullets_callback' ),
                'dm-slider-page2',
                'dm_slider_second_section',
                array(
                    'label_for' => 'dm_slider_bullets',
                )
            );

            add_settings_field(
                'dm_slider_style',
                esc_html__('Slider Styles', 'dm-slider'),
                array( $this, 'dm_slider_styles_callback' ),
                'dm-slider-page2',
                'dm_slider_second_section',
                array(
                    'items' => array(
                        'style-1',
                        'style-2',
                    ),
                    'label_for' => 'dm_slider_style',

                )
            );
        }

        public function dm_slider_shortcode_callback() {
            ?>
            <span><?php esc_html_e('Use the shortcode [dm_slider] to display the slider in any page/post/widget', 'dm-slider')?></span>
            <?php
        }

        public function dm_slider_title_callback($args) {
            ?>
            <input
                type="text"
                name="dm_slider_options[dm_slider_title]"
                id="dm_slider_title"
                value="<?php echo isset(self::$options['dm_slider_title']) ? esc_attr(self::$options['dm_slider_title']) : '' ?>"
            />
            <?php
        }

        public function dm_slider_bullets_callback($args) {
            ?>
            <input
                type="checkbox"
                name="dm_slider_options[dm_slider_bullets]"
                id="dm_slider_bullets"
                value="1"
                <?php checked( '1', isset(self::$options['dm_slider_bullets']) ? self::$options['dm_slider_bullets'] : '' ) ?>
            />
            <label for="dm_slider_bullets"><?php _e('Check to display bullets', 'dm-slider')?></label>
            <?php
        }

        public function dm_slider_styles_callback($args) {
            ?>
            <select
                id="dm_slider_style"
                name="dm_slider_options[dm_slider_style]">
                <?php
                if (isset($args['items']) && is_array($args['items'])) {
                    foreach ($args['items'] as $style) {
                        ?>
                        <option value="<?php echo esc_attr($style); ?>" 
                            <?php selected($style, isset(self::$options['dm_slider_style']) ? self::$options['dm_slider_style'] : ''); ?>>
                            <?php echo esc_html(ucfirst($style)); ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
            <?php
        }
        
        public function dm_slider_validate($input) {
            $new_input = array();
            foreach ($input as $key => $value) {
                switch ($key) {
                    case 'dm_slider_title':
                        if (empty($value)) {
                            add_settings_error(
                                'dm_slider_options',
                                'dm_slider_message',
                                __('The title field is required', 'dm-slider'),
                                'error'
                            );
                            $value = esc_html__('Please, type some text', 'dm-slider');
                        }
                        $value = sanitize_text_field($value); // Sanitiza o título
                        break;
                    case 'dm_slider_bullets':
                    case 'dm_slider_style':
                        $value = sanitize_text_field($value);
                        break;
                }
                $new_input[$key] = $value;
            }
            return $new_input;
        }
        
    }
}