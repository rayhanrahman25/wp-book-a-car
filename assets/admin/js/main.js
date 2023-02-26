  let wpbacCopyShortcode = document.querySelector(".wpbac-shortcode-btn");
  let wpbacUploadImage = document.querySelector(".wpbac-form-upload-image");
  
  if(wpbacCopyShortcode){
    wpbacCopyShortcode.addEventListener("click", function() {
      const text = this.innerText;
      navigator.clipboard.writeText(text)
        .then(() => {
          this.innerText = "[wpbac_booking_page] Copied";
        })
        .catch(err => {
          console.error("Failed to copy text: ", err);
        });
    });
  }

  if(wpbacUploadImage){
    wpbacUploadImage.addEventListener("click", function(e){
      e.preventDefault();
      var frame = wp.media({
        title: 'Upload Image',
        multiple: false
      }).open()
        .on('select', function(e) {
          let wpbacGetImage = frame.state().get('selection').first().toJSON();
          let wpbacGetUrl = wpbacGetImage.url;
          let wpbacPrintImage = document.querySelector('.show-profile-img');
          let wpbacSetInputVal = document.querySelector('input[name="wpbac_form_background_image"]');
          wpbacPrintImage.src = wpbacGetUrl;
          wpbacSetInputVal.setAttribute('value', wpbacGetUrl);
      });

    });
  }


  jQuery(document).ready(function($){

    var mediaUploader;

    $('#custom_media_button').click(function(e) {
        e.preventDefault();

        alert("HELLO");

        // If the media uploader instance exists, reopen it.
        if ( mediaUploader ) {
            mediaUploader.open();
            return;
        }

        // Create a new media uploader instance
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Select Image',
            button: {
                text: 'Select Image'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#term-image').val(attachment.id);
            $('#term-image-preview').html('<img src="' + attachment.url + '">');
        });

        // Open the media uploader dialog
        mediaUploader.open();

    });

    $('#custom_media_remove').click(function() {
        $('#term-image').val('');
        $('#term-image-preview').html('');
    });

});
