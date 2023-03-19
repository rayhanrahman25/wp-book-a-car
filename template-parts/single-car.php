<?php
get_header();
global $wpdb;
		$wpbac_car_id = get_the_ID();
		$get_pickup_dates = $wpdb->get_results( "SELECT wpbac_pickup_date FROM {$wpdb->prefix}wpbac_book_a_car WHERE wpbac_car_id = $wpbac_car_id", ARRAY_A );
		if('' !== $get_pickup_dates ){
			$resverd_dates = '';
			foreach( $get_pickup_dates as $get_pickup_date){
				$datetime = new DateTime($get_pickup_date['wpbac_pickup_date']);
				$today = new DateTime();
				if($datetime > $today) {
				// get reserved dates to show booked alert on calender
				$resverd_dates .= "{
					title: 'Booked',
					start: '".$get_pickup_date['wpbac_pickup_date']."',
					end: '".$get_pickup_date['wpbac_pickup_date']."',
				},";
				}
			}
		}
?>

<script>
    //   Show Events By Book Date
  document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
	headerToolbar: {
		left: 'prev,next today',
		center: 'title',
		right: 'dayGridMonth'
	},
	initialView: 'dayGridMonth',
	navLinks: true,
	editable: true,
	events: [<?php  echo $resverd_dates; ?>],
	});
	calendar.render();
});
</script>

    <section class="ftco-section ftco-car-details">
      <div class="container">
      	<div class="row justify-content-center">
      		<div class="col-md-12">
      			<div class="car-details">
                    <?php the_post_thumbnail(); ?>
      				<div class="text text-center">
      					<h2><?php the_title(); ?></h2>
      				</div>
      			</div>
      		</div>
      	</div>
      	<div class="row">
		<?php
		$wpbac_characteristics = get_the_terms(get_the_ID(), 'wpbac_car_characteristics');
		if ( $wpbac_characteristics && !is_wp_error($wpbac_characteristics)) {
		foreach ($wpbac_characteristics as $characteristics) {
			$image_id = get_term_meta( $characteristics->term_id, 'wpbac-characteristics-image', true );
		?>
      	 <div class="col-md d-flex align-self-stretch">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center">
						<span>
							<?php
								if ( $image_id ) {
									echo wp_get_attachment_image( $image_id);
								}
							?>
						</span>
					</div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
							<span>
								<?php echo '<a href="' . esc_url(get_term_link($characteristics)) . '">' . esc_html($characteristics->name) . '</a> '; ?>
							</span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
		<?php
			}
		}
		?>
      	</div>
    </section>

	<section class="cal-book pb-5">
		<div class="row">
			<div class="col-md-6">
				<div class="container">
					<div id="wpbac-reserved-date"></div>
					<h2 class="text-uppercase pb-5 text-center fw-bold">
						<span class="text-gamboge"><?php echo __('Available', WPBAC_TXT_DOMAIN); ?></span>
						<span class="text-dark"><?php echo __('Dates', WPBAC_TXT_DOMAIN); ?></span>
					</h2>
					<div id='calendar'></div>
				</div>
			</div>
			<div class="col-md-6">
				<?php
				include WPBAC_PATH . 'public/view/' . WPBAC_FILE_PRFX .'booking-form.php';
				?>
			</div>
		</div>
	</section>

    <section class="ftco-section pt-5">
    	<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 heading-section text-center mb-5">
					<span class="subheading"><?php echo __('Choose Car', WPBAC_TXT_DOMAIN); ?></span>
					<h2 class="mb-2"><?php echo __('Related Cars', WPBAC_TXT_DOMAIN); ?></h2>
				</div>
			</div>
			<div class="row">
				<?php
				
					$wpbac_cars_args = array(
						'post_type' => 'cars',
                        'orderby' => 'date',
						'cat' => the_category(),
						'post__not_in' => array(get_the_ID()),
                        'order' => 'DESC',
						'posts_per_page' => 3,
					);
				
				$wpbac_get_cars_query = new WP_Query( $wpbac_cars_args );
				if( $wpbac_get_cars_query->have_posts()) {
					while ( $wpbac_get_cars_query->have_posts() ) {
							$wpbac_get_cars_query->the_post();
				?>
				<div class="col-md-4">
					<div class="car-wrap rounded">
						<div class="wpbac-car-archive-image rounded d-flex align-items-end">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="text">
							<h2 class="mb-0">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="d-flex mb-3">
								<p class="price ml-auto">$500 <span>/day</span></p>
							</div>
							<p class="d-flex mb-0 d-block"><a href="<?php the_permalink(); ?>" class="btn btn-primary py-2 mr-1">Book now</a> <a href="<?php the_permalink(); ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
						</div>
					</div>
				</div>
				<?php
					}
					wp_reset_postdata();
				}
				?>
			</div>
    	</div>
    </section>
    <?php
    get_footer();
    ?>