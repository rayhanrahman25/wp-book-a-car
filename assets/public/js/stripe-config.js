// Set your publishable key.
var stripe = Stripe('pk_test_51M1ul3Cv5P3gBkZqOAHKhG8jMdk2VHMatgNMVkTGIJt8CjOhw3DnjVD63ITMXIR35ZoSLvrviP4EoSk8wEZfYkC100yaAG2ITk');


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

// Handle form submission.
var form = document.querySelector('form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(cardElement).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  var form = document.querySelector('form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  form.submit();
}
