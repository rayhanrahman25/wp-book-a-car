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