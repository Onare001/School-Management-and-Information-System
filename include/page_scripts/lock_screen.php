<script>
	// Set the timeout period to 5 minutes (in milliseconds)
	const timeoutPeriod = 5 * 60 * 1000;

	// Set a timer to log out the user after the timeout period
	let timeoutId = setTimeout(logoutUser, timeoutPeriod);

	// Reset the timer if the user interacts with the page
	document.addEventListener("click", resetTimer);
	document.addEventListener("keypress", resetTimer);

	function resetTimer() {
	  clearTimeout(timeoutId);
	  timeoutId = setTimeout(logoutUser, timeoutPeriod);
	}

	function logoutUser() {
	  // Redirect the user to the logout page or execute any other logout logic
	  window.location.href = "lock_screen<?php echo '?u='.$user_id; ?>";
	}	
</script>
