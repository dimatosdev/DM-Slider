<table class="form-table dm-slider-metabox">
    <input type="hidden" name="dm_slider_nonce" value="<?php echo wp_create_nonce( "dm_slider_nonce" ); ?>">
    <tbody>
        <tr>
            <th>
                <label for="dm-slider-link-text"><?php esc_html_e('Link Text', 'dm-slider') ?></label>
            </th>
            <td>
            <input 
                type="text" 
                name="dm-slider-link-text" 
                id="dm-slider-link" 
                class="regular-text link-input" 
                value="<?php echo esc_attr( get_post_meta( $post->ID, 'dm_slider_link_text', true ) ); ?>"
                required
            >
            </td>
        </tr>
        <tr>
            <th>   
                <label for="dm-slider-link-url"><?php esc_html_e('Link URL', 'dm-slider') ?></label>
            </th>
            <td>
            <input
                type="url"
                name="dm-slider-link-url"
                id="dm-slider-link-url"
                class="regular-text link-url"
                value="<?php echo esc_url( get_post_meta( $post->ID, 'dm_slider_link_url', true ) ); ?>"
                required
            >
            </td>
        </tr>
    </tbody>
</table>