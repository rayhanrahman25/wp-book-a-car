<?php
 $wpbac_characteristics_img_id = get_term_meta( $wpbac_characteristics->term_id, 'wpbac-characteristics-image', true );
?>
<tr class="form-field">
        <th scope="row" valign="top">
            <label for="wpbac-characteristics-image"><?php _e( 'Image', WPBAC_TXT_DOMAIN ); ?></label>
        </th>
        <td class="wpbac-updated-characteristics-image">
            <?php
                if($wpbac_characteristics_img_id) {
                    echo wp_get_attachment_image(esc_attr($wpbac_characteristics_img_id));
                }
            ?>
            <br/><input type="hidden" name="wpbac-characteristics-image" id="wpbac-characteristics-image" value="<?php echo esc_attr($wpbac_characteristics_img_id); ?>">
            <br/><button class="button button-secondary" id="wpbac-upload-characteristics-img" ><?php _e( 'Add Image', WPBAC_TXT_DOMAIN ); ?></button>
            <button class="button button-secondary" id="wpbac-remove-characteristics-img"><?php _e( 'Remove Image', WPBAC_TXT_DOMAIN ); ?></button>
        </td>
</tr>