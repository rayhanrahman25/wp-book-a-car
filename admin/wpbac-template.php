<?php

global $post;
if ( 'cars' === $post->post_type ) {
	$single_template = WPBAC_PATH . 'template-parts/single-car.php';
}



