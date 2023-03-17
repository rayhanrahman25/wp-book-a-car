
	<div id="booking" class="section"  style="background-image:url(<?php // echo esc_attr(get_option( 'wpbac_form_background_image', '#' )); ?>);">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<!-- <div class="form-header">
							<h1><?php // echo esc_html(get_option( 'wpbac_form_title', WPBAC_TXT_DOMAIN )); ?></h1>
						</div> -->
						<form>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label"><?php echo esc_html__('Name', WPBAC_TXT_DOMAIN); ?></span>
										<input class="form-control wpbac-book-name" type="text" placeholder="Enter your name">
										<input class="form-control wpbac-car-id" type="hidden" value="<?php echo get_the_ID(); ?>" placeholder="Enter your name">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label"><?php echo esc_html__('Email', WPBAC_TXT_DOMAIN); ?></span>
										<input class="form-control wpbac-book-email" type="text" placeholder="Enter your email" >
									</div>
								</div>
							</div>
							<div class="form-group">
								<span class="form-label"><?php echo esc_html__('Phone', WPBAC_TXT_DOMAIN); ?></span>
								<input class="form-control wpbac-book-phone" type="number" placeholder="Enter your phone number">
							</div>
							<div class="form-group">
								<span class="form-label"><?php echo esc_html__('Pickup Location', WPBAC_TXT_DOMAIN); ?></span>
								<input class="form-control wpbac-book-pickup" type="text" placeholder="Enter ZIP/Location">
							</div>
							<div class="form-group">
								<span class="form-label"><?php echo esc_html__('Destination', WPBAC_TXT_DOMAIN); ?></span>
								<input class="form-control wpbac-book-destination" type="text" placeholder="Enter ZIP/Location">
							</div>
							<div class="row">
								<div class="col-sm-5">
									<div class="form-group">
										<span class="form-label"><?php echo esc_html__('Pickup Date', WPBAC_TXT_DOMAIN); ?></span>
										<input class="form-control wpbac-book-pickupdate" id="wpbac-book-pickupdate" type="date" required>
									</div>
								</div>
								<div class="col-sm-7">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<span class="form-label"><?php echo esc_html__('Hour', WPBAC_TXT_DOMAIN); ?></span>
												<select class="form-control wpbac-book-hour">
													<option><?php echo esc_html__('01', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('02', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('03', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('04', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('05', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('06', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('07', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('08', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('09', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('10', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('11', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('12', WPBAC_TXT_DOMAIN); ?></option>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<span class="form-label"><?php echo esc_html__('Min', WPBAC_TXT_DOMAIN); ?></span>
												<select class="form-control wpbac-book-min">
												<option><?php echo esc_html__('05', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('10', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('15', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('20', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('25', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('30', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('35', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('40', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('45', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('50', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('55', WPBAC_TXT_DOMAIN); ?></option>
												<option><?php echo esc_html__('00', WPBAC_TXT_DOMAIN); ?></option>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<span class="form-label"><?php echo esc_html__('AM/PM', WPBAC_TXT_DOMAIN); ?></span>
												<select class="form-control wpbac-book-ap">
													<option><?php echo esc_html__('AM', WPBAC_TXT_DOMAIN); ?></option>
													<option><?php echo esc_html__('PM', WPBAC_TXT_DOMAIN); ?></option>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-btn">
								<button class="wpbac-submit-book"><?php echo esc_html__('Book Now', WPBAC_TXT_DOMAIN); ?></button>
							</div>
							<div class="wpbac-message-wrapper">
								<span class="wpbac-submit-message"></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>