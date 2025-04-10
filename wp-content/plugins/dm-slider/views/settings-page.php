<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <?php
        $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'main_options';
    ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=dm-slider-admin&tab=main_options" class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Main Options', 'dm-slider') ?></a>
        <a href="?page=dm-slider-admin&tab=additional_options" class="nav-tab <?php echo $active_tab == 'additional_options' ? 'nav-tab-active': ''; ?>"><?php esc_html_e('Additional Options', 'dm-slider') ?></a>
    </h2>
    <form action="options.php" method="post">
        <?php
        if( $active_tab == 'main_options' ){
            settings_fields( 'dm_slider_group' );
            do_settings_sections( 'dm-slider-page1' );
        } else {
            settings_fields( 'dm_slider_group' );
            do_settings_sections( 'dm-slider-page2' );
        }
        submit_button( __( 'Save Settings', 'd-slider' ));
        ?>
    </form>

</div>