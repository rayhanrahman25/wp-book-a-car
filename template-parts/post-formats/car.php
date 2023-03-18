
<div class="col-md-4">
	<div class="car-wrap rounded">
    	<div class="wpbac-car-archive-image rounded d-flex align-items-end">
            <?php the_post_thumbnail(); ?>
    	</div>
		<div class="text">
			<h2 class="mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="d-flex mb-3">
				<p class="price ml-auto">$500 <span>/day</span></p>
			</div>
			<p class="d-flex mb-0 d-block"><a href="<?php the_permalink(); ?>" class="btn btn-primary py-2 mr-1">Book now</a> <a href="<?php the_permalink(); ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
		</div>
	</div>
</div>