<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *	Admin Main
 */

require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'thank-you.php';

class Wpbac_admin{
    private $wpbac_version;

    public function __construct( $version )
    {
       $this->wpbac_version = $version;
    }

    public function wpbac_admin_assets(){
        wp_register_style( 'wpbac-admin-css', WPBAC_ASSETS . 'admin/css/style.css', array(), WPBAC_VERSION, FALSE );
        wp_enqueue_style('wpbac-admin-css');
    }

    public function wpbac_admin_menu() {
        add_menu_page(
            __( 'Book A Car', WPBAC_TXT_DOMAIN ),
            __( 'Book A Car', WPBAC_TXT_DOMAIN ),
            'manage_options',
            'wpbac-admin-settings',
            array( $this, WPBAC_PRFX . 'key_settings' ),
            'dashicons-car',
            100
        );
        add_submenu_page(
            'wpbac-admin-settings',
            __( 'All Bookings',WPBAC_TXT_DOMAIN ),
            __( 'All Bookings',WPBAC_TXT_DOMAIN ),
            'manage_options',
            'wpbac-all-bookings',
            array( $this, WPBAC_PRFX . 'all_bookings' )
        );
        add_submenu_page(
            'wpbac-admin-settings',
            __( 'General Settings',WPBAC_TXT_DOMAIN ),
            __( 'General Settings',WPBAC_TXT_DOMAIN ),
            'manage_options',
            'wpsd-general-settings',
            array( $this, WPBAC_PRFX . 'general_settings' )
        );
        
    }

    function wpbac_all_bookings(){
        require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'booking-lists.php';
    }
}