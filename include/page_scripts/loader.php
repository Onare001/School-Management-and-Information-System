	<script>
		var counter = 0; // initialize counter to zero
		var interval = setInterval(function() { // set up interval to run every 0.5 seconds
			document.getElementById("counter").innerHTML = "Loading... " + counter; // update counter display
			counter++;
			if (counter == 10) { // stop interval after 10 iterations
				clearInterval(interval);
				document.getElementById("counter").innerHTML = "Ready"; // display final message
			}
		}, 500); // 0.5 seconds in milliseconds
	</script>
	<script>
		function displayMessage(message) {
		  var messagesDiv = document.getElementById("messages");
		  messagesDiv.innerHTML = message;
		}

		displayMessage("Collecting data...");
		setTimeout(function() {
		  displayMessage("Fetching subjects...");
		  setTimeout(function() {
			displayMessage("Fetching scores...");
			setTimeout(function() {
			  displayMessage("Totalling...");
			  setTimeout(function() {
				displayMessage("Grading...");
				setTimeout(function() {
				displayMessage("Commenting...");
				setTimeout(function() {
				  displayMessage("Checking form teacher comment...");
				  setTimeout(function() {
					displayMessage("Allocating position...");
					setTimeout(function() {
					displayMessage("Ready...");
				  }, 1000);
				}, 1000);
			  }, 1000);
			}, 1000);
		  }, 1000);
		}, 1000);
		}, 1000);
		}, 1000);
	</script>
	