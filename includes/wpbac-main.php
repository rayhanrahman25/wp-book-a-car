<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WPBAC Main Class: Plugin
 */

 class Wpbac_Main_Class{

    protected $wpbac_version;

    function __construct()
    {
        $this->wpbac_version = WPBAC_VERSION;
        $this->wpbac_load_dependencies();
        $this->wpbac_trigger_admin_hooks();
        $this->wpbac_trigger_public_hooks();
        $this->wpbac_install_tables();
    }
    
    // -- Load Plugin Text Domain
    function wpbac_load_plugin_textdomain()
    {
        load_plugin_textdomain( WPBAC_TXT_DOMAIN , FALSE , WPBAC_TXT_DOMAIN . '/languages/' );
    }

    private function wpbac_load_dependencies(){
      require_once WPBAC_PATH . 'admin/'. WPBAC_FILE_PRFX .'admin.php';
      require_once WPBAC_PATH . 'public/'. WPBAC_FILE_PRFX .'public.php';
    }

    private function wpbac_trigger_admin_hooks(){ 
      $wpbac_admin = new Wpbac_admin($this->wpbac_version);
      add_action( 'admin_menu', array( $wpbac_admin,  WPBAC_PRFX . 'admin_menu' ) );
      add_action( 'admin_enqueue_scripts', array($wpbac_admin , WPBAC_PRFX . 'admin_assets' ));
    }

    private function wpbac_trigger_public_hooks(){
      $wpbac_public = new Wpbac_public($this->wpbac_version);
      add_action('wp_enqueue_scripts', array($wpbac_public,  WPBAC_PRFX . 'public_assets' ));
      add_shortcode( 'wpbac_booking_page', array( $wpbac_public, 'wpbac_load_shortcode_view' ) );
    }
   
    private function wpbac_install_tables(){
      global  $wpdb ;
      $table_name = WPBAC_TABLE;
      
      if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
          //table not in database. Create new table
          $charset_collate = $wpdb->get_charset_collate();
          $sql = "CREATE TABLE {$table_name} (\r\n\t\t\t\t\twpbac_id INT(11) NOT NULL AUTO_INCREMENT,\r\n\t\t\t\t\twpbac_user_name VARCHAR(255),\r\n\t\t\t\t\twpbac_user_email VARCHAR(55),\r\n\t\t\t\t\twpbac_phone_number VARCHAR(55),\r\n\t\t\t\t\twpbac_pickup_location VARCHAR(255),\r\n\t\t\t\t\twpbac_destination VARCHAR(255),\r\n\t\t\t\t\twpbac_pickup_date DATETIME,\r\n\t\t\t\t\twpbac_pickup_hour INT(2),\r\n\t\t\t\t\twpbac_pickup_min INT(2),\r\n\t\t\t\t\twpbac_am_pm INT(2),\r\n\t\t\t\t\tPRIMARY KEY (`wpbac_id`)\r\n\t\t\t) {$charset_collate};";
          require_once ABSPATH . 'wp-admin/includes/upgrade.php';
          dbDelta( $sql );
      }
  }

 }

