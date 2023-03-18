<?php
get_header(); 
?>
<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
                <?php
                    $wpbac_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $wpbac_args = array(
                        'post_type' => 'cars',
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'paged' =>$wpbac_paged,
                    );

                    $wpbac_get_the_cars = new WP_Query($wpbac_args);

                    if ($wpbac_get_the_cars->have_posts()) :
                        while ($wpbac_get_the_cars->have_posts()) : $wpbac_get_the_cars->the_post();
                        include WPBAC_PATH .'/template-parts/post-formats/car.php';
                        endwhile;
                ?>
    		</div>
    		<div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <?php
                            global $wp_query;
                            $wpbac_max_pages = 999999999;
                            $wpbac_cars_paginate_links = paginate_links( array(
                                'base' => str_replace( $wpbac_max_pages, '%#%', esc_url( get_pagenum_link( $wpbac_max_pages ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages,
                                'prev_next' => true,
                                'prev_text' => __('&lt;'),
                                'next_text' => __('&gt;'),
                                'type' => 'array',
                                'show_all' => false,
                                'end_size' => 1,
                                'mid_size' => 2,
                                'add_args' => false,
                                'add_fragment' => '',
                            ) );
                            if ( $wpbac_cars_paginate_links ) {
                                foreach ( $wpbac_cars_paginate_links as  $wpbac_cars_paginate_link ){
                                    echo '<li>' . $wpbac_cars_paginate_link . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            else:
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">
                            <span class="text-dark"><?php echo __('Cars', WPBAC_TXT_DOMAIN); ?></span>
					        <span class="text-gamboge"><?php echo __('Not Found', WPBAC_TXT_DOMAIN); ?></span>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
            endif;
            ?>
    	</div>
</section>
<?php
get_footer();
?>
