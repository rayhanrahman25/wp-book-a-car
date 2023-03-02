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

    $('#wpbac-upload-characteristics-img').click(function(e) {
        e.preventDefault();

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
            $('#wpbac-characteristics-image').val(attachment.id);
            $('#wpbac-characteristics-img-preview').html('<img class="wpbac-updated-characteristics-image" src="' + attachment.url + '">');
        });

        mediaUploader.open();

    });

    $('#wpbac-remove-characteristics-img').click(function() {
        $('#wpbac-characteristics-image').val('');
        $('#wpbac-characteristics-img-preview').html('');
    });

});
