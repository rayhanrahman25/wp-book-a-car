<?php
/*
 * Plugin Name:       WP Book A Car
 * Plugin URI:        https://github.com/rayhanrahman25/book-a-car
 * Description:       Book A Car Is A WordPress Plugin, Using This Plugin You Can Create Car Booking Website Your Won
 * Version:           0.0.5
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Rayhan Rahman
 * Author URI:        https://github.com/rayhanrahman25/book-a-car
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       book-a-car
 * Domain Path:       /languages
 */


 define('WPBAC_PATH', plugin_dir_path(__FILE__));
 define('WPBAC_ASSETS', plugins_url('/assets/', __FILE__));
 define('WPBAC_LANG', plugins_url('/languages/', __FILE__));
 define('WPBAC_SLUG', plugin_basename(__FILE__));
 define('WPBAC_PRFX', 'wpbac_');
 define('WPBAC_FILE_PRFX', 'wpbac-');
 define('WPBAC_TXT_DOMAIN', ' book-a-car');
 define('WPBAC_VERSION', '0.0.5');
 define('WPBAC_TABLE', $wpdb->prefix . 'wpbac_book_a_car');

 // Required Files
 
 require_once WPBAC_PATH . 'includes/'. WPBAC_FILE_PRFX .'main.php';
 new wpbac_Main_Class();