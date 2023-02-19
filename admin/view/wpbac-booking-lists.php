<table class="wpbac-booking-list">
  <tr>
    <th><?php echo esc_html__( 'Name', WPBAC_TXT_DOMAIN ) ?></th>
    <th><?php echo esc_html__( 'Email', WPBAC_TXT_DOMAIN ) ?></th>
    <th><?php echo esc_html__( 'Phone', WPBAC_TXT_DOMAIN ) ?></th>
    <th><?php echo esc_html__( 'Pickup Location', WPBAC_TXT_DOMAIN ) ?></th>
    <th><?php echo esc_html__( 'Destination', WPBAC_TXT_DOMAIN ) ?></th>
    <th><?php echo esc_html__( 'Pickup Date', WPBAC_TXT_DOMAIN ) ?></th>
    <th><?php echo esc_html__( 'Pickup Time', WPBAC_TXT_DOMAIN ) ?></th>
  </tr>
  <?php
   global $wpdb;
   $wpbac_booking_information = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpbac_book_a_car", ARRAY_A );
   foreach( $wpbac_booking_information as  $wpbac_booking_info){
    $wpbac_pickup_hour = $wpbac_booking_info['wpbac_pickup_hour'];
    $wpbac_pickup_min = $wpbac_booking_info['wpbac_pickup_min'];
    $wpbac_am_pm = $wpbac_booking_info['wpbac_am_pm'];

  ?>
  <tr>
    <td><?php echo esc_html($wpbac_booking_info['wpbac_user_name']); ?></td>
    <td><?php echo esc_html($wpbac_booking_info['wpbac_user_email']); ?></td>
    <td><?php echo esc_html($wpbac_booking_info['wpbac_phone_number']); ?></td>
    <td><?php echo esc_html($wpbac_booking_info['wpbac_pickup_location']); ?></td>
    <td><?php echo esc_html($wpbac_booking_info['wpbac_destination']); ?></td>
    <td><?php echo esc_html($wpbac_booking_info['wpbac_pickup_date']); ?></td>
    <td>
      <?php
       echo esc_html($wpbac_pickup_hour).":".esc_html($wpbac_pickup_min).esc_html($wpbac_am_pm);
      ?>
    </td>
  </tr>
  <?php
   }
  ?>
</table>
</body>
</html>
