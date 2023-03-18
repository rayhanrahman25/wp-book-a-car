<?php

global $post;

if ( is_post_type_archive ( 'cars' ) ) {
     $wpbac_archive_template =  WPBAC_PATH . 'template-parts/car-archive.php';
}