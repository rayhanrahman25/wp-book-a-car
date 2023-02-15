jQuery(document).ready( function() {

    jQuery(".wpbac-submit-book").click( function(e) {
       e.preventDefault(); 

       post_id = jQuery(this).attr("data-post_id")
       nonce = jQuery(this).attr("data-nonce")
 
       jQuery.ajax({
          type : "post",
          dataType : "json",
          url : wpbac_public.ajaxurl,
          data : {action: "my_user_vote", post_id : post_id, nonce: nonce},
          success: function(response) {
             if(response.type == "success") {
                jQuery("#vote_counter").html(response.vote_count)
             }
             else {
                alert("Your vote could not be added")
             }
          }
       }); 
 
    });
 
 });