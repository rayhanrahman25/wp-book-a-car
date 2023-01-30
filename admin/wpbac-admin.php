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
        $wpbac_admin_page = $_GET['page'] ?? '';
        $wpbac_plugin_pages = array('wpbac-all-bookings', 'wpbac-admin-settings');
        if( !in_array($wpbac_admin_page, $wpbac_plugin_pages) ){
            return;
        }
        wp_register_style( 'wpbac-bootstrp-css', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), null , FALSE );
        wp_register_style( 'wpbac-admin-css', WPBAC_ASSETS . 'admin/css/style.css', array(), WPBAC_VERSION, FALSE );
        wp_register_style( 'wpbac-fontawesome-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), null, FALSE );
        wp_enqueue_style('wpbac-bootstrp-css');
        wp_enqueue_style('wpbac-admin-css');
        wp_enqueue_style('wpbac-fontawesome-css');
        
        wp_register_script( 'wpbac-main-js', WPBAC_ASSETS . 'admin/js/main.js', array('jquery'), WPBAC_VERSION, true );
        wp_register_script( 'wpbac-bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array(), '1.0.0', true );
        wp_enqueue_script('wpbac-bootstrap-js');
        wp_enqueue_script('wpbac-main-js');
    }

    public function wpbac_admin_menu() {
        add_menu_page(
            __( 'WP Book A Car', WPBAC_TXT_DOMAIN ),
            __( 'WP Book A Car', WPBAC_TXT_DOMAIN ),
            'manage_options',
            'wpbac-admin-settings',
            array( $this, WPBAC_PRFX . 'admin_settings' ),
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
            __( 'Settings',WPBAC_TXT_DOMAIN ),
            __( 'Settings',WPBAC_TXT_DOMAIN ),
            'manage_options',
            'wpbac-admin-settings-fields',
            array( $this, WPBAC_PRFX . 'settings' )
        );


        
    }

    function wpbac_admin_settings(){
        require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'admin-settings.php';
    }

    function wpbac_all_bookings(){
        require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'booking-lists.php';
    }

    function wpbac_settings(){
      echo "HELLO WELCOME TO ADMIN SETTINGS";
    }
}