
<div class="col-md-4">
	<div class="car-wrap rounded">
    	<div class="wpbac-car-archive-image rounded d-flex align-items-end">
            <?php the_post_thumbnail(); ?>
    	</div>
		<div class="text">
			<h2 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="d-flex mb-3">
				<p class="price ml-auto text-dark">
					<?php
						echo __('$', WPBAC_TXT_DOMAIN) . get_post_meta( get_the_ID() , 'wpbac_car_rent_price_field', true ); 
					?>
					<span class="text-gamboge fw-bold">
						<?php echo __('/day', WPBAC_TXT_DOMAIN); ?>
					</span>
				</p>
			</div>
			<p class="d-flex mb-0 d-block">
				<a href="<?php the_permalink(); ?>" class="btn bg-gamboge py-2 mr-1">
					<?php echo __('Book now', WPBAC_TXT_DOMAIN); ?>
				</a> 
				<a href="<?php the_permalink(); ?>" class="btn btn-secondary py-2 ml-1">
					<?php echo __('Details', WPBAC_TXT_DOMAIN); ?>
				</a>
			</p>
		</div>
	</div>
</div>