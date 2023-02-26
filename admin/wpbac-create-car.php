<?php
// ===== Custom Car Post Type ====

$wpbac_cars_labels = array(
    'name' => 'Cars',
    'singular_name' => 'car',
    'menu_name' => 'Cars',
    'all_items' => 'All Cars',
    'add_new_item' => 'Add New Car',
    'edit_item' => 'Edit Car',
    'new_item' => 'New Car',
    'view_item' => 'View Car',
    'search_items' => 'Search Cars',
    'not_found' => 'No cars found',
    'not_found_in_trash' => 'No cars found in Trash',
    'parent_item_colon' => '',
    'public' => true,
);

$wpbac_cars_args = array(
    'labels' => $wpbac_cars_labels,
    'description' => 'Custom post type for cars',
    'public' => true,
    'menu_icon' => 'dashicons-car',
    'supports' => array('title', 'editor', 'thumbnail'),
    'has_archive' => true,
    'rewrite' => array('slug' => 'cars'),
    'menu_position' => 80,
);

register_post_type('cars', $wpbac_cars_args);

// ===== Custom Car Taxonomy ====

$wpbac_cars_categories = array(
    'label'        => __( 'Categories', WPBAC_TXT_DOMAIN ),
    'public'       => true,
    'rewrite'      => false,
    'hierarchical' => true
);

register_taxonomy( 'wpbac_car_categories', 'cars', $wpbac_cars_categories );

$wpbac_cars_characteristics = array(
    'label'        => __( 'Characteristic', WPBAC_TXT_DOMAIN ),
    'public'       => true,
    'rewrite'      => false,
    'hierarchical' => true
);

register_taxonomy( 'wpbac_car_characteristics', 'cars', $wpbac_cars_characteristics );

