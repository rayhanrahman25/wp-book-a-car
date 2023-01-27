<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

require_once WPBAC_PATH . 'admin/'. WPBAC_FILE_PRFX .'admin.php';

/**
 * WPBAC Main Class: Plugin
 */

 class Wpbac_Main_Class{

    protected $wpbac_version;

    function __construct()
    {
        $this->wpbac_version = WPBAC_VERSION;
        $this->wpbac_trigger_admin_hooks();
        //$this->wpsd_trigger_front_hooks();
         //$this->wpsd_load_dependencies();
    }

    private function wpbac_trigger_admin_hooks(){ 
       $wpbac_admin = new wpbac_admin($this->wpbac_version);
       add_action( 'admin_menu', array( $wpbac_admin,  WPBAC_PRFX . 'admin_menu' ) );
    }

 }

 new wpbac_Main_Class();

