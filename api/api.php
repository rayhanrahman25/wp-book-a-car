<?php


class CarsAPI {

    public function __construct() {
      add_action( 'rest_api_init', array( $this,  WPBAC_PRFX . 'register_routes' ) );
    }
  
    // register routes for cars api
    public function wpbac_register_routes() {
      register_rest_route( 'wp-book-a-car/v1', '/cars', array(
        'methods' => 'GET',
        'callback' => array( $this, WPBAC_PRFX . 'get_cars' ),
      ) );
  
      register_rest_route( 'wp-book-a-car/v1', '/create-a-car', array(
        'methods' => 'POST',
        'callback' => array( $this,  WPBAC_PRFX . 'create_car' ),
      ) );
    }
    
    // get cars that all ready in database
    public function wpbac_get_cars() {
      $args = array(
        'post_type' => 'cars',
        'post_status' => 'publish',
        'posts_per_page' => -1
      );
  
      $get_cars = new WP_Query( $args );
      $cars = $get_cars->get_posts();
  
      return $cars;
    }
  
    // crate a new car 
    public function wpbac_create_car( WP_REST_Request $request ) {
      $car_data = $request->get_params();
      if( $car_data ){
        $new_car = array(
          'post_title' => sanitize_text_field( $car_data['title'] ),
          'post_content' => sanitize_textarea_field( $car_data['content'] ) ,
          'post_type' => 'cars',
          'post_status' => 'publish'
        );
  
        $car_id = wp_insert_post( $new_car );
  
        return new WP_REST_Response( array(
          'success' => true,
          'message' => 'New car created',
          'post_id' => $car_id
        ), 200 );
      }
    }

  }
  
new CarsAPI();
  

