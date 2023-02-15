<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *	Admin Main
 */

require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'thank-you.php';

class Wpbac_admin{
    protected $wpbac_version;
    protected $wpbac_admin_settings_fields;
    protected $wpbac_section_name;

    public function __construct( $version )
    {
       $this->wpbac_version = $version;
       $this->wpbac_admin_settings_fields = 'wpbac_admin_settings_fields';
       $this->wpbac_section_name = 'wpbac_admin_settings_seciton';
    }

    public function wpbac_admin_styles() {
        $wpbac_admin_page = $_GET['page'] ?? '';
        $wpbac_plugin_pages = array('wpbac-all-bookings', 'wpbac-admin-settings', 'wpbac-admin-home');
        if( !in_array($wpbac_admin_page, $wpbac_plugin_pages) ){
            return;
        }
        wp_register_style( 'wpbac-bootstrp-css', '//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), null , FALSE );
        wp_register_style( 'wpbac-admin-css', WPBAC_ASSETS . 'admin/css/style.css', array(), WPBAC_VERSION, FALSE );
        wp_register_style( 'wpbac-fontawesome-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), null, FALSE );
        wp_enqueue_style('wpbac-bootstrp-css');
        wp_enqueue_style('wpbac-admin-css');
        wp_enqueue_style('wpbac-fontawesome-css');
    }

    public function wpbac_admin_scripts() {
        $wpbac_admin_page = $_GET['page'] ?? '';
        $wpbac_plugin_pages = array('wpbac-all-bookings', 'wpbac-admin-settings', 'wpbac-admin-home');
        if( !in_array($wpbac_admin_page, $wpbac_plugin_pages) ){
            return;
        }
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
            'wpbac-admin-home',
            array( $this, WPBAC_PRFX . 'admin_home' ),
            'dashicons-car',
            100
        );
        add_submenu_page(
            'wpbac-admin-home',
            __( 'All Bookings',WPBAC_TXT_DOMAIN ),
            __( 'All Bookings',WPBAC_TXT_DOMAIN ),
            'manage_options',
            'wpbac-all-bookings',
            array( $this, WPBAC_PRFX . 'all_bookings' )
        );

        add_submenu_page(
            'wpbac-admin-home',
            __( 'Settings',WPBAC_TXT_DOMAIN ),
            __( 'Settings',WPBAC_TXT_DOMAIN ),
            'manage_options',
            'wpbac-admin-settings',
            array( $this, WPBAC_PRFX . 'settings' )
        );
        
    }

    function wpbac_admin_home() {
        require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'admin-home.php';
    }

    function wpbac_all_bookings() {
        require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'booking-lists.php';
    }

    function wpbac_settings() {
        ?>
        <div class="wrap">
        <h2><?php echo __('Settings', WPBAC_TXT_DOMAIN); ?></h2>
        <form method="post" action="options.php">
            <?php
                settings_fields('wpbac_admin_options');
                do_settings_sections( 'wpbac_admin_options' );
                submit_button();
            ?>
        </form>
    </div> 
    <?php
    }

    public function wpbac_admin_sections() {
        add_settings_section( $this->wpbac_section_name , false , null , 'wpbac_admin_options' );
    }

    public function wpbac_admin_settings_fields() {
        $wpbac_settings_fields = array(
            array(
                'id' => 'wpbac_form_title',
                'label' => 'Form Title',
                'section' => $this->wpbac_section_name,
                'type' => 'text',
                'options' => false,
                'default' => __('Book A Car', WPBAC_TXT_DOMAIN),
            ),
            array(
                'id' => 'wpbac_form_background_image',
                'label' => 'Upload Background Image',
                'section' => $this->wpbac_section_name,
                'type' => 'hidden',
                'options' => false,
                'default' => WPBAC_ASSETS . 'images/background.jpg',
            ),

        );

        foreach( $wpbac_settings_fields as $wpbac_settings_field ){
            add_settings_field( $wpbac_settings_field['id'], $wpbac_settings_field['label'], array( $this, WPBAC_PRFX . 'settings_callback' ), 'wpbac_admin_options', $wpbac_settings_field['section'], $wpbac_settings_field );
            register_setting( 'wpbac_admin_options', $wpbac_settings_field['id'] );
        }

    }

    public function wpbac_settings_callback( $wpbac_settings_args ) {
        
        if( 'wpbac_form_title' === $wpbac_settings_args['id'] ){
            $wpbac_form_title_value = esc_attr(get_option( $wpbac_settings_args['id'] ));
            if( !$wpbac_form_title_value ){
                $wpbac_form_title_value =  $wpbac_settings_args['default'];
            }
            printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', esc_attr($wpbac_settings_args['id']), esc_attr($wpbac_settings_args['type']), esc_attr($wpbac_settings_args['placeholder']), esc_attr($wpbac_form_title_value));
        }

        if( 'wpbac_form_background_image'  === $wpbac_settings_args['id'] ){
            $wpbac_form_background_image = esc_attr(get_option( $wpbac_settings_args['id'] ));
            if(!$wpbac_form_background_image){
                $wpbac_form_background_image =  $wpbac_settings_args['default'];
            }
            printf('<img class="show-profile-img" src="%s"><br/><br/>', esc_attr($wpbac_form_background_image));
            printf( '<input type="%2$s" id="%1$s" name="%1$s" value="%3$s">',  esc_attr($wpbac_settings_args['id']), esc_attr($wpbac_settings_args['type']), esc_attr($wpbac_form_background_image));
            ?>
            <input type="button" class="button button-primary wpbac-form-upload-image" value="Upload Image" />
            <?php
        }
    }

}