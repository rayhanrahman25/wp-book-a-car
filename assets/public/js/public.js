jQuery(document).ready( function($) {
   'use strict';

   // ================================== Stripe Config And Validation  ================================

   var stripe = Stripe(wpbac_public.public_key);

   var style = {
      base: {
         color: "#32325d",
         fontSmoothing: "antialiased",
         fontSize: "16px",
      padding: "10px",
      borderColor: "#ddbe40",
         "::placeholder": {
            color: "#000000"
         }
      },
      invalid: {
         fontFamily: 'Arial, sans-serif',
         color: "#fa755a",
         iconColor: "#fa755a"
      }
   };

   // Create a Stripe Element for the card.
   var elements = stripe.elements();
   var cardElement = elements.create('card', {hidePostalCode: true,style:style});

   // Mount the Stripe Element to the DOM.
   cardElement.mount('#card-element');

   // sending data to backend 
   var wpbacToday = new Date();
   var wpbacTomorrow = new Date(wpbacToday.getTime() + 24 * 60 * 60 * 1000);
   var wpabacDateFromt = wpbacTomorrow.toISOString().substring(0, 10);
   document.getElementById("wpbac-book-pickupdate").setAttribute("min", wpabacDateFromt);
   $(".wpbac-submit-book").click( function(e) {
   e.preventDefault();
  
   stripe.createToken(cardElement).then(function(result) {
      if (result.error) {
         // Inform the user if there was an error.
         var errorElement = document.getElementById('card-errors');
         errorElement.innerHTML = result.error;
      }
      stripeTokenHandler(result.token);
      let stripeToken = $('#stripetoken').val();
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
      // Check Input Email Is Valid Or Not
      function isValidEmail(email) {
         var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
         return pattern.test(email);
      }
   
     
      if('' !== wpbacName && '' !== wpbacEmail && '' !== wpbacPhone && 
      '' !== wpbacPickup && '' !== wpbacDestination && '' !== wpbacPickupDate && 
      '' !== wpbacHour && '' !== wpbacMin && '' !== wpbacAP) {
      
      if(!isValidEmail(wpbacEmail)) {
         $(".wpbac-message-wrapper").css("display","block");
         $(".wpbac-submit-message").html("Please Enter Valid Email Address");
         return;
      }
      
      $.ajax({
         type : "post",
         dataType : "json",
         url : wpbac_public.ajaxurl,
         data : {
            action: "user_booked_data",
            stripe_token: stripeToken,
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
            setTimeout(function(){
               location.reload();
         }, 1000); 
         }else if(response.date_exist){
            $(".wpbac-message-wrapper").css("display","block");
            $(".wpbac-submit-message").html(response.message);
         }else{
            $(".wpbac-message-wrapper").css("display","block");
            $(".wpbac-submit-message").html("Something Went Wrong");
         }
         }
      });
      }else{
         $(".wpbac-message-wrapper").css("display","block");
         $(".wpbac-submit-message").html("Please fill all fields");
      }
     
   });

   });

//Submit the form with the token ID.
function stripeTokenHandler(token) {
  var form = document.querySelector('#booking-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('id','stripetoken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
}
 
});


