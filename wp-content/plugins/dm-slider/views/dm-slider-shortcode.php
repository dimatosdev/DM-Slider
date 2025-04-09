<h3><?php echo ( ! empty ( $content ) ) ? esc_html($content) : esc_html(DM_Slider_Settings::$options['dm_slider_title']); ?></h3>
<div class="dm-slider flexslider <?php echo (isset(DM_Slider_Settings::$options['dm_slider_style'])) ? esc_attr(DM_Slider_Settings::$options['dm_slider_style']) : 'style-1'; ?>">
    <ul class="slides">
        <?php 
        $args = array(
            'post_type' => 'dm-slider',
            'post_status' => 'publish',
            'orderby' => $orderby,
            'post__in' => $id,
        );

        $my_query = new WP_Query( $args );

        if ( $my_query->have_posts() ) : 
            while ( $my_query->have_posts() ) : $my_query->the_post();

                $button_text = get_post_meta( get_the_ID(), 'dm_slider_link_text', true );
                $button_url = get_post_meta( get_the_ID(), 'dm_slider_link_url', true );
            ?>
            <li>
                <?php 
                if ( has_post_thumbnail() ){
                    the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
                }else{
                    echo dm_slider_get_pladeholder_image();
                }
                ?>
                <div class="dms-container">
                    <div class="slider-details-container"> 
                        <div class="wrapper">
                            <div class="slider-title">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <div class="slider-description">
                                <div class='subtitle'><?php the_content(); ?></div>
                                <a class='link' href='<?php echo esc_url($button_url) ?>'><?php echo esc_attr($button_text) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
</div>