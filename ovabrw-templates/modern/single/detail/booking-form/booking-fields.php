<?php if ( ! defined( 'ABSPATH' ) ) exit();
	global $product;
	if ( ! $product ) return;

	$product_id = $product->get_id();

	$rental_type 			= get_post_meta( $product_id, 'ovabrw_price_type', true );
	$show_pickup_loc 		= ovabrw_show_pick_location_product( $product_id, 'pickup' );
	$show_pickoff_loc 		= ovabrw_show_pick_location_product( $product_id, 'dropoff' );
	$show_pickup_date 		= ovabrw_show_pick_date_product( $product_id, 'pickup' );
	$show_pickoff_date 		= ovabrw_show_pick_date_product( $product_id, 'dropoff' );
	$show_quantity 			= ovabrw_show_number_vehicle( $product_id );
	$st_pickup_loc   		= get_post_meta( $product_id, 'ovabrw_st_pickup_loc', true );
	$st_dropoff_loc  		= get_post_meta( $product_id, 'ovabrw_st_dropoff_loc', true );
	$defined_one_day 		= defined_one_day( $product_id );
	$time_to_book_start 	= ovabrw_time_to_book( $product_id, 'start' );
	$time_to_book_end 		= ovabrw_time_to_book( $product_id, 'end' );
	$default_hour_start 	= ovabrw_get_default_time( $product_id, 'start' );
	$default_hour_end 		= ovabrw_get_default_time( $product_id, 'end' );
	$timepicker_start 		= OVABRW_Get_Data::instance()->get_pickup_time_picker( $product_id );
	$timepicker_end 		= OVABRW_Get_Data::instance()->get_dropoff_time_picker( $product_id );
	$disable_week_day 		= get_post_meta( $product_id, 'ovabrw_product_disable_week_day', true );
	$dropoff_date_setting 	= get_post_meta( $product_id, 'ovabrw_dropoff_date_by_setting', true );

	// Get booked time
	$statuses 	= brw_list_order_status();
	$order_time = OVABRW_Get_Data::instance()->get_order_rent_time( $product_id, $statuses );
	$dateformat = ovabrw_get_date_format();
	$timeformat = ovabrw_get_time_format_php();

	// Placeholder
	$placeholder_date = ovabrw_get_placeholder_date();
	$placeholder_time = ovabrw_get_placeholder_time();

	$placeholder_startdate = $placeholder_date;
	if ( $timepicker_start ) {
		$placeholder_startdate .= ' '.$placeholder_time;
	}

	$placeholder_enddate = $placeholder_date;
	if ( $timepicker_end ) {
		$placeholder_enddate .= ' '.$placeholder_time;
	}
	
	// Get data
	$pickup_loc 	= isset( $_GET['pickup_loc'] ) ? $_GET['pickup_loc'] : '';
	$pickoff_loc 	= isset( $_GET['pickoff_loc'] ) ? $_GET['pickoff_loc'] : '';
	$pickup_date 	= ovabrw_get_current_date_from_search( $timepicker_start, 'pickup_date', $product_id );
	$dropoff_date 	= ovabrw_get_current_date_from_search( $timepicker_end, 'dropoff_date', $product_id );
	$pickup_time 	= isset( $_GET['pickup_time'] ) ? $_GET['pickup_time'] : '';
	
	if ( ! $pickup_time ) {
		$pickup_time = strtotime( $pickup_date ) ? $default_hour_start : '';
	}

	// Get first day in week
	$first_day = get_option( 'ova_brw_calendar_first_day', '0' );

	if ( empty( $first_day ) ) {
		$first_day = 0;
	}

	// Preparation Time
	$preparation_time = get_post_meta( $product_id, 'ovabrw_preparation_time', true );
?>
<?php if ( in_array( $rental_type, [ 'day', 'hour', 'mixed', 'hotel' ] ) ): ?>
	<!-- Day, Hour, Mixed, Hotel -->
	<?php if ( $show_pickup_loc ): ?>
		<div class="rental_item">
			<label><?php esc_html_e( 'Pick-up Location', 'ova-brw' ); ?></label>
			<div class="error_item">
				<label><?php esc_html_e( 'This field is required', 'ova-brw' ); ?></label>
			</div>
			<?php
				if ( ! empty( $st_pickup_loc ) && ! empty( $st_dropoff_loc ) ) {
					echo OVABRW_Get_Data::instance()->get_html_couple_location( 'ovabrw_pickup_loc', 'required', $pickup_loc, $product_id, 'pickup' );
				} else {
					echo OVABRW_Get_Data::instance()->get_html_location( 'ovabrw_pickup_loc', 'required', $pickup_loc, $product_id, 'pickup' );
				}
			?>
			<div class="ovabrw-other-location"></div>
		</div>
	<?php endif; ?>
	<?php if ( $show_pickoff_loc ): ?>
		<div class="rental_item">
			<label><?php esc_html_e( 'Drop-off Location', 'ova-brw' ); ?></label>
			<div class="error_item">
				<label><?php esc_html_e( 'This field is required', 'ova-brw' ); ?></label>
			</div>
			<?php
				if ( ! empty( $st_pickup_loc ) && ! empty( $st_dropoff_loc ) ) {
					echo OVABRW_Get_Data::instance()->get_html_couple_location( 'ovabrw_pickoff_loc', 'required', $pickoff_loc, $product_id, 'dropoff' );
				} else {
					echo OVABRW_Get_Data::instance()->get_html_location( 'ovabrw_pickoff_loc', 'required', $pickoff_loc, $product_id, 'dropoff' );
				}
			?>
			<div class="ovabrw-other-location"></div>
		</div>
	<?php endif; ?>
	<div class="rental_item">
		<label>
			<?php echo esc_html( OVABRW_Get_Data::instance()->get_label_pickup_date( $product_id ) ); ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
			</label>
		</div>
		<input
			type="text"
			name="ovabrw_pickup_date"
			default_hour="<?php echo esc_attr( $default_hour_start ); ?>"
			time_to_book="<?php echo esc_attr( $time_to_book_start ); ?>"
			class="required ovabrw_datetimepicker ovabrw_start_date"
			placeholder="<?php echo esc_attr( $placeholder_startdate ); ?>"
			value="<?php echo esc_attr( $pickup_date ); ?>"
			order_time="<?php echo esc_attr( $order_time ); ?>"
			data-pid="<?php echo esc_attr( $product_id ); ?>"
			timepicker="<?php echo $timepicker_start ? 'true' : 'false'; ?>"
			data-firstday="<?php echo esc_attr( $first_day ); ?>"
			data-preparation-time="<?php echo esc_attr( $preparation_time ); ?>"
			data-disable-week-day="<?php echo esc_attr( $disable_week_day ); ?>"
			autocomplete="off"
			onfocus="blur();"
		/>
	</div>
	<?php if ( $show_pickoff_date ): ?>
		<div class="rental_item">
			<label>
				<?php echo esc_html( OVABRW_Get_Data::instance()->get_label_pickoff_date( $product_id ) ); ?>
			</label>
			<div class="error_item">
				<label>
					<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
				</label>
			</div>
			<input
				type="text"
				name="ovabrw_pickoff_date"
				default_hour="<?php echo esc_attr( $default_hour_end ); ?>"
				time_to_book="<?php echo esc_attr( $time_to_book_end ); ?>"
				class="required ovabrw_datetimepicker ovabrw_end_date" 
				placeholder="<?php echo esc_attr( $placeholder_enddate ); ?>"
				value="<?php echo esc_attr( $dropoff_date ); ?>"
				order_time="<?php echo esc_attr( $order_time ); ?>"
				timepicker="<?php echo $timepicker_end ? 'true' : 'false'; ?>"
				data-firstday="<?php echo esc_attr( $first_day ); ?>"
				data-preparation-time="<?php echo esc_attr( $preparation_time ); ?>"
				data-disable-week-day="<?php echo esc_attr( $disable_week_day ); ?>"
				autocomplete="off"
				onfocus="blur();"
			/>
		</div>
	<?php endif; ?>
	<?php if ( $rental_type === 'hotel' ): ?>
		<?php ovabrw_get_template('modern/single/detail/ovabrw-product-guests.php'); ?>
	<?php endif; ?>
	<!-- End Day, Hour, Mixed, Hotel -->
<?php endif; ?>
<?php if ( $rental_type === 'period_time' ): ?>
	<!-- Period of Time -->
	<?php if ( $show_pickup_loc ): ?>
		<div class="rental_item">
			<div class="labelForm">
				<svg xmlns="http://www.w3.org/2000/svg" width="20.146" height="26.861" viewBox="0 0 20.146 26.861">
					<path id="Icon_awesome-map-marker-alt" data-name="Icon awesome-map-marker-alt"
						d="M9.038,26.319C1.415,15.268,0,14.134,0,10.073a10.073,10.073,0,0,1,20.146,0c0,4.061-1.415,5.2-9.038,16.246a1.26,1.26,0,0,1-2.07,0ZM10.073,14.27a4.2,4.2,0,1,0-4.2-4.2A4.2,4.2,0,0,0,10.073,14.27Z"
						fill="#152C48" />
				</svg>

				<?php esc_html_e('Pick up location', 'hello-elementor-child'); ?>
			</div>
			<div class="error_item">
				<label><?php esc_html_e( 'This field is required', 'ova-brw' ); ?></label>
			</div>
			<?php
				if ( ! empty( $st_pickup_loc ) && ! empty( $st_dropoff_loc ) ) {
					echo OVABRW_Get_Data::instance()->get_html_couple_location( 'ovabrw_pickup_loc', 'required', $pickup_loc, $product_id, 'pickup' );
				} else {
					echo OVABRW_Get_Data::instance()->get_html_location( 'ovabrw_pickup_loc', 'required', $pickup_loc, $product_id, 'pickup' );
				}
			?>
			<div class="ovabrw-other-location"></div>
		</div>
	<?php endif; ?>
	<?php if ( $show_pickoff_loc ): ?>
		<div class="rental_item">
			<label><?php esc_html_e( 'Drop-off Location', 'ova-brw' ); ?></label>
			<div class="error_item">
				<label><?php esc_html_e( 'This field is required', 'ova-brw' ); ?></label>
			</div>
			<?php
				if ( ! empty( $st_pickup_loc ) && ! empty( $st_dropoff_loc ) ) {
					echo OVABRW_Get_Data::instance()->get_html_couple_location( 'ovabrw_pickoff_loc', 'required', $pickoff_loc, $product_id, 'dropoff' );
				} else {
					echo OVABRW_Get_Data::instance()->get_html_location( 'ovabrw_pickoff_loc', 'required', $pickoff_loc, $product_id, 'dropoff' );
				}
			?>
			<div class="ovabrw-other-location"></div>
		</div>
	<?php endif; ?>
	<div class="rental_item">
		<div class="labelForm" id="icon_calendar">
			<?php esc_html_e('Select the date', 'hello-elementor-child'); ?>
		</div>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
			</label>
		</div>
		<input
			type="text"
			name="ovabrw_pickup_date"
			default_hour="<?php echo esc_attr( $default_hour_start ); ?>"
			time_to_book="<?php echo esc_attr( $time_to_book_start ); ?>"
			class="required ovabrw_datetimepicker ovabrw_start_date startdate_perido_time"
			placeholder="<?php echo esc_attr( $placeholder_startdate ); ?>"
			value="<?php echo esc_attr( $pickup_date ); ?>"
			order_time="<?php echo esc_attr( $order_time ); ?>"
			data-pid="<?php echo esc_attr( $product_id ); ?>"
			timepicker="<?php echo $timepicker_start ? 'true' : 'false'; ?>"
			data-firstday="<?php echo esc_attr( $first_day ); ?>"
			data-preparation-time="<?php echo esc_attr( $preparation_time ); ?>"
			data-disable-week-day="<?php echo esc_attr( $disable_week_day ); ?>"
			autocomplete="off"
			onfocus="blur();"
		/>
	</div>
	<?php
		$ovabrw_petime_id 		= get_post_meta( $product_id, 'ovabrw_petime_id', true );
		$ovabrw_petime_label 	= get_post_meta( $product_id, 'ovabrw_petime_label', true );
	?>
	<?php if ( ! empty( $ovabrw_petime_id ) && ! empty( $ovabrw_petime_label ) ):
		$default_package 	= '';
		$package_durations 	= isset( $_GET['ovabrw_package'] ) ? intval( $_GET['ovabrw_package'] ) : '';
		

		if ( $package_durations ) {
			$default_package = OVABRW_Get_Data::instance()->get_package_id_by_durations( $product_id, $package_durations );
		}
	?>
		<div class="rental_item">
		<div class="labelForm">
			<svg id="tickettype" data-name="tickettype" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"  width="30" height="30" >
			<path d="m29.36,10.68L19.3.63c-.84-.84-2.15-.84-2.98,0L.63,16.32C.22,16.73-.01,17.29,0,17.87c.01.56.24,1.07.64,1.45l2.14,2.14c.37.37.96.41,1.38.1,1.23-.91,2.94-.79,3.98.28,1.07,1.09,1.2,2.81.3,3.99-.32.42-.28,1.01.1,1.39l2.16,2.16c.4.4.95.63,1.51.63.01,0,.03,0,.04,0,.56-.01,1.07-.24,1.45-.64l15.68-15.68c.41-.41.64-.98.63-1.55-.01-.56-.24-1.07-.64-1.45ZM17.83,2.12s-.01,0-.02,0h.02Zm7.11,12.99l-1.9-1.88-1.49,1.51,1.89,1.87-11.25,11.25-1.56-1.56c.95-1.93.6-4.35-.97-5.95-1.56-1.6-3.99-1.96-5.97-.98l-1.56-1.56L13.39,6.56l1.9,1.93,1.51-1.49-1.91-1.93,2.92-2.92,10.06,10.06-2.92,2.92Z" style="fill: #124b71;"/>
			<rect x="18.13" y="8.9" width="2.12" height="3.9" transform="translate(-2.05 16.74) rotate(-45)" style="fill: #124b71;"/>
			</svg>
			<?php esc_html_e('Ticket type', 'hello-elementor-child'); ?>
		</div>
			<div class="error_item">
				<label>
					<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
				</label>
			</div>
			<div class="period_package">
				<select name="ovabrw_period_package_id" class="required">
					<option value=""><?php esc_html_e( 'Select Package', 'ova-brw' ); ?></option>
					<?php foreach ( $ovabrw_petime_id as $key => $value ): ?>
						<option value="<?php echo esc_attr( trim( $value ) ); ?>"<?php selected( $value, $default_package ); ?>> 
							<?php echo isset( $ovabrw_petime_label[$key] ) ? esc_html( $ovabrw_petime_label[$key] ) : ''; ?> 
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	<?php endif; ?>
	<!-- End Period of Time -->
<?php endif; ?>
<?php if ( $rental_type === 'transportation' ): ?>
	<!-- Location -->
	<div class="rental_item">
		<label><?php esc_html_e( 'Pick-up Location', 'ova-brw' ); ?></label>
		<div class="error_item">
			<label><?php esc_html_e( 'This field is required', 'ova-brw' ); ?></label>
		</div>
		<?php
			echo OVABRW_Get_Data::instance()->get_html_location_transportation( 'ovabrw_pickup_loc', 'required', $pickup_loc, $product_id, 'pickup' );
		?>
		<div class="ovabrw-other-location"></div>
	</div>
	<div class="rental_item">
		<label><?php esc_html_e( 'Drop-off Location', 'ova-brw' ); ?></label>
		<div class="error_item">
			<label><?php esc_html_e( 'This field is required', 'ova-brw' ); ?></label>
		</div>
		<?php
			echo OVABRW_Get_Data::instance()->get_html_location_transportation( 'ovabrw_pickoff_loc', 'required', $pickoff_loc, $product_id, 'dropoff' );
		?>
		<div class="ovabrw-other-location"></div>
	</div>
	<div class="rental_item">
		<label>
			<?php echo esc_html( OVABRW_Get_Data::instance()->get_label_pickup_date( $product_id ) ); ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
			</label>
		</div>
		<input
			type="text"
			name="ovabrw_pickup_date"
			default_hour="<?php echo esc_attr( $default_hour_start ); ?>"
			time_to_book="<?php echo esc_attr( $time_to_book_start ); ?>"
			class="required ovabrw_datetimepicker ovabrw_start_date"
			placeholder="<?php echo esc_attr( $placeholder_startdate ); ?>"
			value="<?php echo esc_attr( $pickup_date ); ?>"
			order_time="<?php echo esc_attr( $order_time ); ?>"
			data-pid="<?php echo esc_attr( $product_id ); ?>"
			timepicker="<?php echo $timepicker_start ? 'true' : 'false'; ?>"
			data-firstday="<?php echo esc_attr( $first_day ); ?>"
			data-preparation-time="<?php echo esc_attr( $preparation_time ); ?>"
			data-disable-week-day="<?php echo esc_attr( $disable_week_day ); ?>"
			autocomplete="off"
			onfocus="blur();"
		/>
	</div>
	<?php if ( $show_pickoff_date && $dropoff_date_setting === 'yes' ): ?>
		<div class="rental_item">
			<label>
				<?php echo esc_html( OVABRW_Get_Data::instance()->get_label_pickoff_date( $product_id ) ); ?>
			</label>
			<div class="error_item">
				<label>
					<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
				</label>
			</div>
			<input
				type="text"
				name="ovabrw_pickoff_date"
				default_hour="<?php echo esc_attr( $default_hour_end ); ?>"
				time_to_book="<?php echo esc_attr( $time_to_book_end ); ?>"
				class="required ovabrw_datetimepicker ovabrw_end_date"
				placeholder="<?php echo esc_attr( $placeholder_enddate ); ?>"
				value="<?php echo esc_attr( $dropoff_date ); ?>"
				order_time="<?php echo esc_attr( $order_time ); ?>"
				timepicker="<?php echo $timepicker_end ? 'true' : 'false'; ?>"
				data-firstday="<?php echo esc_attr( $first_day ); ?>"
				data-preparation-time="<?php echo esc_attr( $preparation_time ); ?>"
				data-disable-week-day="<?php echo esc_attr( $disable_week_day ); ?>"
				autocomplete="off"
				onfocus="blur();"
			/>
		</div>
	<?php endif; ?>
	<!-- End Location -->
<?php endif; ?>
<?php if ( $rental_type === 'taxi' ):
	// Data $_GET
	$pickup_location 		= isset( $_GET['pickup_loc'] ) ? $_GET['pickup_loc'] : '';
	$dropoff_location 		= isset( $_GET['pickoff_loc'] ) ? $_GET['pickoff_loc'] : '';
	$origin_location 		= isset( $_GET['origin_location'] ) ? $_GET['origin_location'] : '';
	$destination_location 	= isset( $_GET['destination_location'] ) ? $_GET['destination_location'] : '';
	$duration 				= isset( $_GET['duration'] ) ? $_GET['duration'] : '';
	$distance 				= isset( $_GET['distance'] ) ? $_GET['distance'] : '';

	// Get data by product ID
	$ovabrw_price_by 	= get_post_meta( $product_id, 'ovabrw_map_price_by', true );
	$ovabrw_waypoint 	= get_post_meta( $product_id, 'ovabrw_waypoint', true );
	$ovabrw_zoom_map 	= get_post_meta( $product_id, 'ovabrw_zoom_map', true );
	$extra_time_hour 	= get_post_meta( $product_id, 'ovabrw_extra_time_hour', true );
	$extra_time_label 	= get_post_meta( $product_id, 'ovabrw_extra_time_label', true );
	$ovabrw_lat 		= get_post_meta( $product_id, 'ovabrw_latitude', true );
	$ovabrw_lng 		= get_post_meta( $product_id, 'ovabrw_longitude', true );

	if ( ! $ovabrw_price_by ) $ovabrw_price_by = 'km';

	if ( ! $ovabrw_lat ) {
		$ovabrw_lat = get_option( 'ova_brw_latitude_map_default', 39.177972 );
	}

	if ( ! $ovabrw_lng ) {
		$ovabrw_lng = get_option( 'ova_brw_longitude_map_default', -100.36375 );
	}

	$max_waypoint 	= get_post_meta( $product_id, 'ovabrw_max_waypoint', true );
	$map_types 		= get_post_meta( $product_id, 'ovabrw_map_types', true );
	$ovabrw_bounds 	= get_post_meta( $product_id, 'ovabrw_bounds', true );
	$bounds_lat 	= get_post_meta( $product_id, 'ovabrw_bounds_lat', true );
	$bounds_lng 	= get_post_meta( $product_id, 'ovabrw_bounds_lng', true );
	$bounds_radius 	= get_post_meta( $product_id, 'ovabrw_bounds_radius', true );
	$restrictions 	= get_post_meta( $product_id, 'ovabrw_restrictions', true );

	if ( ! $map_types ) $map_types = [ 'geocode' ];
	if ( ! $restrictions ) $restrictions = [];
?>
	<!-- Taxi -->
	<div class="rental_item">
		<label>
			<?php echo esc_html( OVABRW_Get_Data::instance()->get_label_pickup_date( $product_id ) ); ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
			</label>
		</div>
		<input
			type="text"
			name="ovabrw_pickup_date"
			class="required ovabrw_datetimepicker ovabrw_start_date"
			placeholder="<?php echo esc_attr( $placeholder_startdate ); ?>"
			value="<?php echo esc_attr( $pickup_date ); ?>"
			order_time="<?php echo esc_attr( $order_time ); ?>"
			data-pid="<?php echo esc_attr( $product_id ); ?>"
			timepicker="false"
			data-firstday="<?php echo esc_attr( $first_day ); ?>"
			data-preparation-time="<?php echo esc_attr( $preparation_time ); ?>"
			data-disable-week-day="<?php echo esc_attr( $disable_week_day ); ?>"
			autocomplete="off"
			onfocus="blur();"
		/>
	</div>
	<div class="rental_item">
		<label>
			<?php esc_html_e( 'Pick-up Time' ); ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
			</label>
		</div>
		<input 
			type="text"
			name="ovabrw_pickup_time"
			default_hour="<?php echo esc_attr( $default_hour_start ); ?>"
			time_to_book="<?php echo esc_attr( $time_to_book_start ); ?>"
			class="required ovabrw_timepicker ovabrw_start_time"
			placeholder="<?php echo esc_attr( $placeholder_time ); ?>"
			autocomplete="off"
			value="<?php echo esc_attr( $pickup_time ); ?>"
			data-pid="<?php echo esc_attr( $product_id ); ?>"
			onfocus="blur();"
		/>
	</div>
	<div class="rental_item form-location-field">
		<label>
			<?php esc_html_e( 'Pick-up Location' ); ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
			</label>
		</div>
		<input
			type="text"
			id="ovabrw_pickup_loc"
			class="required"
			name="ovabrw_pickup_loc"
			value="<?php echo esc_attr( $pickup_location ); ?>"
			placeholder="<?php esc_html_e( 'Enter your location', 'ova-brw' ); ?>"
			autocomplete="off"
		/>
		<input
			type="hidden"
			id="ovabrw_origin"
			name="ovabrw_origin"
			value="<?php echo esc_attr( stripslashes( stripslashes( $origin_location ) ) ); ?>"
		/>
		<?php if ( $ovabrw_waypoint === 'on' ): ?>
			<i aria-hidden="true" class="flaticon-add btn-add-waypoint"></i>
		<?php endif; ?>
	</div>
	<div class="rental_item form-location-field">
		<label>
			<?php esc_html_e( 'Drop-off Location' ); ?>
		</label>
		<div class="error_item">
			<label>
				<?php esc_html_e( 'This field is required', 'ova-brw' ); ?>
			</label>
		</div>
		<input
			type="text"
			id="ovabrw_pickoff_loc"
			class="required"
			name="ovabrw_pickoff_loc"
			value="<?php echo esc_attr( $dropoff_location ); ?>"
			placeholder="<?php esc_html_e( 'Enter your location', 'ova-brw' ); ?>"
			autocomplete="off"
		/>
		<input
			type="hidden"
			id="ovabrw_destination"
			name="ovabrw_destination"
			value="<?php echo esc_attr( stripslashes( stripslashes( $destination_location ) ) ); ?>"
		/>
	</div>
	<?php if ( ! empty( $extra_time_hour ) && ! empty( $extra_time_label ) ): ?>
	<div class="rental_item">
		<label>
			<?php esc_html_e( 'Extra Time', 'ova-brw' ); ?>
		</label>
		<select name="ovabrw_extra_time">
			<option value=""><?php esc_html_e( 'Select Time', 'ova-brw' ); ?></option>
			<?php foreach ( $extra_time_hour as $k => $time ):
				$ext_label = isset( $extra_time_label[$k] ) ? $extra_time_label[$k] : '';
			?>
				<option value="<?php echo esc_attr( $time ); ?>">
					<?php echo esc_html( $ext_label ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php endif; ?>
	<input
		type="hidden"
		name="ovabrw-data-location"
		data-price-by="<?php echo esc_attr( $ovabrw_price_by ); ?>"
		data-waypoint-text="<?php esc_html_e( 'Waypoint', 'ova-brw' ); ?>"
		data-max-waypoint="<?php echo esc_attr( $max_waypoint ); ?>"
		data-map-types="<?php echo esc_attr( json_encode( $map_types ) ); ?>"
		data-lat="<?php echo esc_attr( $ovabrw_lat ); ?>"
		data-lng="<?php echo esc_attr( $ovabrw_lng ); ?>"
		data-zoom="<?php echo esc_attr( $ovabrw_zoom_map ); ?>"
		data-bounds="<?php echo esc_attr( $ovabrw_bounds ); ?>"
		data-bounds-lat="<?php echo esc_attr( $bounds_lat ); ?>"
		data-bounds-lng="<?php echo esc_attr( $bounds_lng ); ?>"
		data-bounds-radius="<?php echo esc_attr( $bounds_radius ); ?>"
		data-restrictions="<?php echo esc_attr( json_encode( $restrictions ) ); ?>"
	/>
	<input
		type="hidden"
		name="ovabrw-duration-map"
		value="<?php echo esc_attr( $duration ); ?>"
	/>
	<input
		type="hidden"
		name="ovabrw-duration"
		value="<?php echo esc_attr( $duration ); ?>"
	/>
	<input
		type="hidden"
		name="ovabrw-distance"
		value="<?php echo esc_attr( $distance ); ?>"
	/>
	<!-- End Taxi -->
<?php endif; ?>
<?php if ( $show_quantity === 'yes' ): $stock_qty = OVABRW_Get_Data::instance()->get_stock_quantity( $product_id );

	$quantity = isset( $_GET['ovabrw_quantity'] ) ? absint( $_GET['ovabrw_quantity'] ) : 1;
?>
	<div class="rental_item">
	<div class="error_item"></div>
		<div class="labelForm">
			<svg xmlns="http://www.w3.org/2000/svg" width="27.219" height="17.321" viewBox="0 0 27.219 17.321">
				<path id="Icon_material-people" data-name="Icon material-people"
					d="M20.059,14.923a3.712,3.712,0,1,0-3.712-3.712A3.7,3.7,0,0,0,20.059,14.923Zm-9.9,0a3.712,3.712,0,1,0-3.712-3.712A3.7,3.7,0,0,0,10.161,14.923Zm0,2.474c-2.883,0-8.661,1.448-8.661,4.33v3.093H18.821V21.728C18.821,18.845,13.043,17.4,10.161,17.4Zm9.9,0c-.359,0-.767.025-1.2.062A5.221,5.221,0,0,1,21.3,21.728v3.093h7.423V21.728C28.719,18.845,22.941,17.4,20.059,17.4Z"
					transform="translate(-1.5 -7.5)" fill="#152C48" />
			</svg>
			<?php esc_html_e('Quantity', 'hello-elementor-child'); ?>
		</div>
		<input
			type="number"
			class="required"
			name="ovabrw_number_vehicle"
			value="<?php echo esc_attr( $quantity ); ?>"
			min="1"
			max="<?php echo esc_attr( $stock_qty ); ?>"
		/>
	</div>
<?php endif; ?>
<?php if ( $rental_type === 'taxi' ):
	$price_by = get_post_meta( $product_id, 'ovabrw_map_price_by', true );

	if ( ! $price_by ) $price_by = 'km';
?>
	<div class="ovabrw-directions">
		<div id="ovabrw_map" class="ovabrw_map"></div>
		<div class="directions-info">
			<div class="distance-sum">
				<h3 class="label"><?php esc_html_e( 'Total Distance', 'ova-brw' ); ?></h3>
				<span class="distance-value">0</span>
				<?php if ( $price_by === 'km' ): ?>
					<span class="distance-unit"><?php esc_html_e( 'km', 'ova-brw' ); ?></span>
				<?php else: ?>
					<span class="distance-unit"><?php esc_html_e( 'mi', 'ova-brw' ); ?></span>
				<?php endif; ?>
			</div>
			<div class="duration-sum">
				<h3 class="label"><?php esc_html_e( 'Total Time', 'ova-brw' ); ?></h3>
				<span class="hour">0</span>
				<span class="unit"><?php esc_html_e( 'h', 'ova-brw' ); ?></span>
				<span class="minute">0</span>
				<span class="unit"><?php esc_html_e( 'm', 'ova-brw' ); ?></span>
			</div>
		</div>
	</div>
<?php endif; ?>

<script type="text/javascript">

// $ = jQuery;

// $(function(){
//     window.setTimeout( function() {
// 		$('.ovabrw_datetimepicker').on( 'click', function() {
// 			var date = new Date();
// 			date.setDate(date.getDate() + 2);

// 			var month = parseInt(date.getMonth()) + 1;
// 			date = date.getDate() + '-' + month + '-' + date.getFullYear();

// 			jQuery('.ovabrw_datetimepicker').datetimepicker( {
// 				startDate: date,
// 				minDate: date
// 			} );
// 		} );
// 	}, 100);
// });
</script>