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

    }

    public function wpbac_public_scripts(){
        wp_register_script( 'wpbac-public-js',  WPBAC_ASSETS . 'public/js/public.js', array('jquery'), WPBAC_VERSION, true );
        wp_enqueue_script( 'wpbac-public-js' );
        wp_localize_script( 'wpbac-public-js', 'wpbac_public', array('ajaxurl'=> admin_url('admin-ajax.php')) );
    }

    public function wpbac_load_shortcode_view(){
         include WPBAC_PATH . 'public/view/' . WPBAC_FILE_PRFX .'booking-form.php';
    }

}