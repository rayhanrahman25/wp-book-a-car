<?php
// Creating Thank You Page
function wpbac_create_thank_you_page() {
      
    $thank_you_page   = 'WPBAC Thank You';
    $check_page_exist = get_page_by_title($thank_you_page , 'OBJECT', 'page');
    $post_content     = '<h1>' . __('Thank You For Booking') . '</h1>';
    $post_content     .= '<p>' . __('We have sent you an email with the booking information') . '</p>';
    if ( empty( $check_page_exist ) ) {
        wp_insert_post( array(
            'comment_status' => 'close',
            'ping_status'    => 'close',
            'post_author'    => 1,
            'post_title'     => ucwords($thank_you_page ),
            'post_name'      => sanitize_title($thank_you_page),
            'post_status'    => 'publish',
            'post_content'   => $post_content,
            'post_type'      => 'page',
            'post_parent'    => ''
            )
        );
    }
  }
 add_action( 'init', 'wpbac_create_thank_you_page' );