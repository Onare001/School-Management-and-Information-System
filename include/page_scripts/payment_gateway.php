<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    var uid = "<?php echo encrypt($uid); ?>";
	var class_id = "<?php echo encrypt($class_id); ?>";
	var cat = "<?php echo encrypt($cat_id); ?>";
	
	function removeSymbolsAndSpaces(number) {
		// Convert the input to a string and remove spaces, commas, and currency symbols
		const cleanedNumber = String(number).replace(/[^\d.-]/g, '');

		// Convert the cleaned string back to a number and return it
		return Number(cleanedNumber);
	}
	
	function Percent(value) {
		return (0.5/100) * value;
	}

	$(document).ready(function() {    
	$('#payment-dropdown').on('change', function() {
			var payment_id = this.value;
			$.ajax({
				url: "include/fetch_request.php",
				type: "POST",
				data: {
					payment_id: payment_id
				},
				cache: false,
				success: function(result){
					$("#amount-dropdown").html(result);
				}
			}); 
		});
	});

	const paymentForm = document.getElementById('paymentForm');
	paymentForm.addEventListener("submit", payWithPaystack, false);
	function payWithPaystack(e) {
	  e.preventDefault();

		var reference = document.getElementById("reference").value;
		var amount = document.getElementById("amount").value;
		var processed_amount = removeSymbolsAndSpaces(amount);
		var x = Percent(processed_amount);
		var pt = document.getElementById("payment-dropdown").value;
		var term = document.getElementById("term").value;
		var session = document.getElementById("session").value;
		
		$.ajax({
		  url: 'save_data.php',
		  type: 'POST',
		  data: {
			"teller_no": reference,
			"amount_paid": processed_amount,
			"uid": uid,
			"pt": pt,
			"class": class_id,
			"cat": cat,
			"term": term,
			"session": session,
			"sch_id": <?php echo $sch_id;?>
			},
			success: function(response){
				console.log(response);
				toastr.success("Processing Transaction...");
			  },
			cache: false,
			error: function(error){
			console.log(error);
		  }
		});

	  let handler = PaystackPop.setup({
		key: '<?php echo $public_key;?>',//pk_test_8e5536652ca115d577a896db088ec04aead9da75,
		email: document.getElementById("email-address").value,
		amount: (processed_amount) * 100 + x * 100,
		lastname: document.getElementById("last-name").value,
		firstname: document.getElementById("first-name").value,
		message: document.getElementById("payment-dropdown").value,
		ref: document.getElementById("reference").value,
		// label: "Optional string that replaces customer email"
		onClose: function(){
			toastr.error("You closed the window, and for this reason we couldn't validate your payment");
			window.location = "/sms/attempted_tranx?uid=" + uid;
		  //alert('Window closed.');
		},
		callback: function(response){
		  let message = 'Payment complete! Reference: ' + response.reference;
		  //alert(message);
		  window.location = "/sms/verify_payment?reference=" + response.reference + "&uid=" + uid;
		}
	  });

	  handler.openIframe();
	}
		
function formatMoney(event) {
  const maxAmount = document.getElementById("amount-dropdown").value;; // set the maximum amount here
  
  let input = event.target.value;
  // Remove all non-numeric characters
  input = input.replace(/[^0-9]/g, '');
  // Format as money
  input = "₦" + Number(input).toLocaleString('en-US');
  
  // Check if input exceeds the maximum amount
  const numericInput = Number(input.replace(/[^0-9]/g, ''));
  if (numericInput > maxAmount) {
    input = "₦" + maxAmount.toLocaleString('en-US');
  }
  
  // Update input value
  event.target.value = input;
  
  // Show red boundary if input is invalid
  if (event.target.value === "$NaN") {
    event.target.classList.add("error");
  } else {
    event.target.classList.remove("error");
  }
}

</script>
<script>
  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
	}
</script>
