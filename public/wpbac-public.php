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
        wp_register_style( 'wpbac-stripe-css', WPBAC_ASSETS . 'public/css/stripe.css', array(), WPBAC_VERSION, false );
        wp_enqueue_style( 'wpbac-stripe-css' );
        wp_enqueue_style( 'wpbac-public-bootstrp-css' );
        wp_enqueue_style( 'wpbac-public-css' );

    }

    public function wpbac_public_scripts(){
        wp_register_script( 'wpbac-public-js',  WPBAC_ASSETS . 'public/js/public.js', array('jquery'), WPBAC_VERSION, true );
        wp_register_script( 'wpbac-full-calender', '//cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js', array(), null , true);
        wp_register_script( 'wpbac-stripe-js', '//js.stripe.com/v3/', null , null , false);
        wp_enqueue_script( 'wpbac-stripe-js');
        wp_enqueue_script( 'wpbac-full-calender' );
        wp_enqueue_script( 'wpbac-public-js' );
        wp_localize_script( 'wpbac-public-js', 'wpbac_public', array('ajaxurl'=> admin_url('admin-ajax.php'), 'public_key'=> esc_attr(get_option( 'wpbac_public_key' ) ) ) );
    }

    public function wpbac_load_shortcode_view(){
        include WPBAC_PATH . 'public/view/' . WPBAC_FILE_PRFX .'booking-form.php';
    }

    public function wpbac_car_archive($wpbac_archive_template){
        require_once WPBAC_PATH . 'public/view/'. WPBAC_FILE_PRFX .'archive-template.php';
        return $wpbac_archive_template;
    }

    public function wpbac_booked_data(){
        // including stripe 
        require_once WPBAC_PATH . 'vendor/autoload.php';
        // instantiate $wpdb global variable store data in database
        global $wpdb;
        // Including Stripe Payment Gateway And Submit Payment
        $amout = get_post_meta( sanitize_text_field( $_POST['wpbac_car_id']) , 'wpbac_car_rent_price_field', true );
        $stripe_token = $_POST['stripe_token'];
        \Stripe\Stripe::setApiKey(get_option( 'wpbac_secret_key' ));
        try {
            \Stripe\Charge::create([
                'amount' => $amout,
                'currency' => 'usd',
                'description' => 'For car rent',
                'source' => $stripe_token,
                'receipt_email' =>sanitize_text_field( $_POST['wpbac_email'] ), 
                'metadata' => [
                    'name' => sanitize_text_field( $_POST['wpbac_name'] ),
                    'email' => sanitize_text_field( $_POST['wpbac_email'] )
                ]
            ]);
            echo "Hello";
            // User Booking Data
            $wpbac_user_data = array(
            'wpbac_user_name'=> sanitize_text_field( $_POST['wpbac_name'] ),
            'wpbac_user_email'=> sanitize_text_field( $_POST['wpbac_email'] ),
            'wpbac_phone_number'=> sanitize_text_field( $_POST['wpbac_phone'] ),
            'wpbac_pickup_location'=> sanitize_text_field( $_POST['wpbac_pickup'] ),
            'wpbac_destination'=> sanitize_text_field( $_POST['wpbac_destination']),
            'wpbac_pickup_date'=> sanitize_text_field( $_POST['wpbac_pickup_date'] ),
            'wpbac_pickup_hour'=> sanitize_text_field( $_POST['wpbac_hour'] ),
            'wpbac_pickup_min'=> sanitize_text_field( $_POST['wpbac_min'] ),
            'wpbac_am_pm'=> sanitize_text_field( $_POST['wpbac_ap'] ),
            'wpbac_car_id'=> sanitize_text_field( $_POST['wpbac_car_id'] ),
            );
            $table_name = WPBAC_TABLE;
            $date = sanitize_text_field( $_POST['wpbac_pickup_date'] );
            //Prepare and execute the query
            $pickup_date_query = $wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE wpbac_pickup_date = %s", $date);
            $pickup_date = $wpdb->get_var( $pickup_date_query);

            if($pickup_date >= 1) {
                $wpbac_response = array(
                    'date_exist' => true,
                    'message' => 'Date already booked please select another date',
                ); 
                wp_send_json( $wpbac_response );  
                wp_die();
            }else{
            // insert booking data
                $wpdb->insert( WPBAC_TABLE , $wpbac_user_data );
                $wpbac_response = array(
                    'success' => false,
                    'message' => 'Thank you for booking with us!',
                );
                wp_send_json( $wpbac_response );  
                wp_die();
            }
          } catch (\Stripe\Exception\CardException $e) {
            $wpbac_response = array(
                'payment_filed' => true,
                'message' => 'Payment Failed',
            ); 
            wp_send_json( $wpbac_response );  
            wp_die();
          }
        
    }

}