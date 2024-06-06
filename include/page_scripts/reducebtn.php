<script>
function reduceButtons() {
  var buttonContainer = document.getElementById("button-container");
  var buttons = buttonContainer.getElementsByClassName("btn btn-primary");
  var screenWidth = window.innerWidth;
  var buttonCount = buttons.length;

  // Determine whether to show button text or icons based on screen size
  if (screenWidth >= 768) {
    // Show button text if screen width is 768px or greater
    for (var i = 0; i < buttonCount; i++) {
    buttons[0].innerHTML = '<i class="fa fa-arrow-left"></i> Back ';
    buttons[1].innerHTML = '<i class="fa fa-camera"></i> View Photo Album ';
    buttons[2].innerHTML = '<i class="fa fa-tag"></i> Print Student\' ID Card';
    buttons[3].innerHTML = '<i class="fa fa-print"></i> Print Score Sheet';
    buttons[4].innerHTML = '<i class="fa fa-download"></i> View Class Biodata';
	buttons[5].innerHTML = '<i class="fa fa-times"></i> Inactive Students';
    }
  } else {
    // Show icons if screen width is less than 768px
    for (var i = 0; i < buttonCount; i++) {
      // Show different icons if screen width is less than 768px
    buttons[0].innerHTML = '<i class="fa fa-arrow-left"></i>';
    buttons[1].innerHTML = '<i class="fa fa-camera"></i>';
    buttons[2].innerHTML = '<i class="fa fa-tag"></i>';
    buttons[3].innerHTML = '<i class="fa fa-print"></i>';
    buttons[4].innerHTML = '<i class="fa fa-download"></i>';
	buttons[5].innerHTML = '<i class="fa fa-times"></i>';
    }
  }
}

// Call the function on page load and whenever the window is resized
reduceButtons();
window.addEventListener("resize", reduceButtons);
</script>
