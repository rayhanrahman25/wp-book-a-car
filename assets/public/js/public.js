jQuery(document).ready( function($) {

   $(".wpbac-submit-book").click( function(e) {

      e.preventDefault();

      let wpbacName = $('.wpbac-book-name').val();
      let wpbacCarId = $('.wpbac-car-id').val();
      let wpbacEmail = $('.wpbac-book-email').val();
      let wpbacPhone = $('.wpbac-book-phone').val();
      let wpbacPickup = $('.wpbac-book-pickup').val();
      let wpbacDestination =  $('.wpbac-book-destination').val();
      let wpbacPickupDate =  $('.wpbac-book-pickupdate').val();
      let wpbacHour = $('.wpbac-book-hour').find(":selected").val();
      let wpbacMin = $('.wpbac-book-min').find(":selected").val();
      let wpbacAP = $('.wpbac-book-ap').find(":selected").val();

      if('' !== wpbacName && '' !== wpbacEmail && '' !== wpbacPhone && 
      '' !== wpbacPickup && '' !== wpbacDestination && '' !== wpbacPickupDate && 
      '' !== wpbacHour && '' !== wpbacMin && '' !== wpbacAP) {

      $.ajax({
         type : "post",
         dataType : "json",
         url : wpbac_public.ajaxurl,
         data : {
            action: "user_booked_data", 
            wpbac_name : wpbacName,
            wpbac_email : wpbacEmail,
            wpbac_phone : wpbacPhone,
            wpbac_pickup : wpbacPickup,
            wpbac_destination : wpbacDestination,
            wpbac_pickup_date : wpbacPickupDate,
            wpbac_hour : wpbacHour,
            wpbac_min : wpbacMin,
            wpbac_ap : wpbacAP,
            wpbac_car_id : wpbacCarId,
         },
         success: function(response) {
         if(response.success) {
            $(".wpbac-message-wrapper").css("display","block");
            $(".wpbac-submit-message").html(response.message);
         }
         else {
            $(".wpbac-message-wrapper").css("display","block");
            $(".wpbac-submit-message").html("Something Went Wrong");
         }
         }
       });

      } else{
         $(".wpbac-message-wrapper").css("display","block");
         $(".wpbac-submit-message").html("Please fill all fields");
      }
 
   });
 
});

document.addEventListener('DOMContentLoaded', function() {
   var reservedDate = document.getElementById('wpbac-reserved-date').dataset.value;
   var calendarEl = document.getElementById('calendar');
   var calendar = new FullCalendar.Calendar(calendarEl, {
     initialView: 'dayGridMonth',
     events: [ 
      reservedDate,
    ],
   });
   calendar.render();
 });