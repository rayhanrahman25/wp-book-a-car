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
        $wpbac_admin_taxonomy = $_GET['taxonomy'] ?? '';
        $wpbac_plugin_pages = array('wpbac-all-bookings', 'wpbac-admin-settings', 'wpbac-admin-home');
        $wpbac_plugin_taxonomy = array('wpbac_car_characteristics');
        if( !in_array($wpbac_admin_page, $wpbac_plugin_pages) && !in_array($wpbac_admin_taxonomy, $wpbac_plugin_taxonomy)) {
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
        $wpbac_admin_taxonomy = $_GET['taxonomy'] ?? '';
        $wpbac_plugin_pages = array('wpbac-all-bookings', 'wpbac-admin-settings', 'wpbac-admin-home');
        $wpbac_plugin_taxonomy = array('wpbac_car_characteristics');
        if( !in_array($wpbac_admin_page, $wpbac_plugin_pages) &&  !in_array( $wpbac_admin_taxonomy, $wpbac_plugin_taxonomy) ){
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

        
    /**
     * Callback function to display the settings page
     */
    public function wpbac_settings() {
        ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                settings_fields( 'wpbac_settings' );
                do_settings_sections( 'wpbac_admin_settings' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    
    public function wpbac_register_settings() {
        register_setting(
            'wpbac_settings',
            'wpbac_public_key'
        );
        register_setting(
            'wpbac_settings',
            'wpbac_secret_key'
        );
        add_settings_section(
            'wpbac_api_keys_section',
            __( 'API Keys Settings', WPBAC_TXT_DOMAIN ),
            array( $this, 'api_keys_section_callback' ),
            'wpbac_admin_settings'
        );
        add_settings_field(
            'wpbac_public_key',
            __( 'Public API Key', WPBAC_TXT_DOMAIN ),
            array( $this, 'public_key_field_callback' ),
            'wpbac_admin_settings',
            'wpbac_api_keys_section'
        );
        add_settings_field(
            'wpbac_secret_key',
            __( 'Secret API Key', WPBAC_TXT_DOMAIN ),
            array( $this, 'secret_key_field_callback' ),
            'wpbac_admin_settings',
            'wpbac_api_keys_section'
        );
    }
    
    public function api_keys_section_callback() {
        echo '<p>' . esc_html__( 'Enter your stripe API keys below:', WPBAC_TXT_DOMAIN ) . '</p>';
    }
    
    public function public_key_field_callback() {
        echo '<input type="text" name="wpbac_public_key" value="' . esc_attr( get_option( 'wpbac_public_key' ) ) . '">';
    }
    
    public function secret_key_field_callback() {
        echo '<input type="password" name="wpbac_secret_key" value="' . esc_attr( get_option( 'wpbac_secret_key' ) ) . '">';
    }

    function wpbac_rent_price_metabox() {
        add_meta_box( 'wpbac_car_rent_price', 'Rent Price', array($this, 'wpbac_car_rent_price_callback') , 'cars', 'normal', 'high' );
    }

    function wpbac_car_rent_price_callback( $post ) {
        wp_nonce_field( 'cars_save_meta_box_data', 'wpbac_car_rent_price_nonce' );
        $value = get_post_meta( $post->ID, 'wpbac_car_rent_price_field', true );
        echo '<input type="number" id="wpbac_car_rent_price_field" name="wpbac_car_rent_price_field" value="' . esc_attr( $value ) . '">';
    }

    function wpbac_cars_save_meta_box_data( $post_id ) {
        if ( ! isset( $_POST['wpbac_car_rent_price_nonce'] ) ) {
            return;
        }
        if ( ! wp_verify_nonce( $_POST['wpbac_car_rent_price_nonce'], 'cars_save_meta_box_data' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['wpbac_car_rent_price_field'] ) ) {
            $number = sanitize_text_field( $_POST['wpbac_car_rent_price_field'] );
            if ( is_numeric( $number ) ) {
                update_post_meta( $post_id, 'wpbac_car_rent_price_field', $number );
            }
        }
    }

    function wpbac_admin_home() {
        require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'admin-home.php';
    }

    function wpbac_all_bookings() {
        require_once WPBAC_PATH . 'admin/view/'. WPBAC_FILE_PRFX .'booking-lists.php';
    }

    public function wpbac_admin_cars() {
        require_once WPBAC_PATH . 'admin/'. WPBAC_FILE_PRFX .'create-car.php';
    }

    function wpbac_single_car( $single_template ) {
        require_once WPBAC_PATH . 'admin/'. WPBAC_FILE_PRFX .'template.php';
        return $single_template;
    }

    function wpbac_characteristics_image() {
        require_once WPBAC_PATH . 'admin/'. WPBAC_FILE_PRFX .'taxonomy-field.php';
    }

    function wpbac_characteristics_edit_taxonomy($wpbac_characteristics) {
        require_once WPBAC_PATH . 'admin/'. WPBAC_FILE_PRFX .'update-field.php';
    }

    function wpbac_characteristics_image_save($characteristics_id) {
        if ( isset( $_POST['wpbac-characteristics-image'] ) ) {
            $characteristics_image_id = absint( $_POST['wpbac-characteristics-image'] );
            update_term_meta( $characteristics_id, 'wpbac-characteristics-image', $characteristics_image_id );
        }

    }
}