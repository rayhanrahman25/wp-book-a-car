document.querySelector("#wpbac-shortcode-btn").addEventListener("click", function() {
    const text = this.innerText;
    navigator.clipboard.writeText(text)
      .then(() => {
        this.innerText = "['wpbac_booking_page'] Copied";
      })
      .catch(err => {
        console.error("Failed to copy text: ", err);
      });
  });