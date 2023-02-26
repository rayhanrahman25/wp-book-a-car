<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *	Public Main
 */

class Wpbac_public{

    private $wpbac_version;

    function __construct($version)
    {
        $this->wpbac_version = $version;
    }

    public function wpbac_public_styles(){
        wp_register_style( 'wpbac-public-bootstrp-css', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), null , false );
        wp_register_style( 'wpbac-public-css', WPBAC_ASSETS . 'public/css/style.css', array(), WPBAC_VERSION, false );

        wp_enqueue_style( 'wpbac-public-bootstrp-css' );
        wp_enqueue_style( 'wpbac-public-css' );

        if(is_singular( 'cars' )){
            wp_enqueue_style( 'wpbac-public-bootstrp-css' );
            wp_enqueue_style( 'wpbac-public-css' );
        }

    }

    public function wpbac_public_scripts(){
        wp_register_script( 'wpbac-public-js',  WPBAC_ASSETS . 'public/js/public.js', array('jquery'), WPBAC_VERSION, true );
        wp_enqueue_script( 'wpbac-public-js' );
        wp_localize_script( 'wpbac-public-js', 'wpbac_public', array('ajaxurl'=> admin_url('admin-ajax.php')) );
    }

    public function wpbac_load_shortcode_view(){
         include WPBAC_PATH . 'public/view/' . WPBAC_FILE_PRFX .'booking-form.php';
    }

    public function wpbac_booked_data(){
        global $wpdb;

        $wpbac_user_data = array(
            'wpbac_user_name'=> esc_html( $_POST['wpbac_name'] ),
            'wpbac_user_email'=> esc_html( $_POST['wpbac_email'] ),
            'wpbac_phone_number'=> esc_html( $_POST['wpbac_phone'] ),
            'wpbac_pickup_location'=> esc_html( $_POST['wpbac_pickup'] ),
            'wpbac_destination'=> esc_html( $_POST['wpbac_destination']),
            'wpbac_pickup_date'=> esc_html( $_POST['wpbac_pickup_date'] ),
            'wpbac_pickup_hour'=> esc_html( $_POST['wpbac_hour'] ),
            'wpbac_pickup_min'=> esc_html( $_POST['wpbac_min'] ),
            'wpbac_am_pm'=> esc_html( $_POST['wpbac_ap'] ),
        );

        $wpdb->insert( WPBAC_TABLE , $wpbac_user_data );
         echo $_POST['wpbac_ap'];
        $wpbac_response = array(
            'success' => true,
            'message' => 'Thank you for booking with us!',
        );
        wp_send_json( $wpbac_response );  
        wp_die();
    }

}