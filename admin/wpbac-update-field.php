<?php
 $image_id = get_term_meta( $term->term_id, 'term-image', true );
?>
<tr class="form-field">
        <th scope="row" valign="top">
            <label for="term-image"><?php _e( 'Image', 'textdomain' ); ?></label>
        </th>
        <td>
            <?php
            if ( $image_id ) {
                echo wp_get_attachment_image( $image_id, 'thumbnail' );
            }
            ?>
            <input type="hidden" name="term-image" id="term-image" value="<?php echo $image_id; ?>">
            <button class="button button-secondary" id="term-image-upload-button"><?php _e( 'Upload/Add Image', 'textdomain' ); ?></button>
            <button class="button button-secondary" id="term-image-remove-button"><?php _e( 'Remove Image', 'textdomain' ); ?></button>
        </td>
</tr>