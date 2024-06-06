<script>
const checkboxes = document.getElementsByName('checkbox[]');
const checkAll = document.getElementById('check-all');
const deleteButton = document.getElementById('deleteButton');

// Check/uncheck all checkboxes when "Check All" checkbox is clicked
checkAll.addEventListener('click', function() {
  for (let i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = checkAll.checked;
  }
  toggleDeleteButton(); // Toggle the delete button based on checkbox selection
});

// Toggle the delete button based on checkbox selection
function toggleDeleteButton() {
  let checked = false;
  for (let j = 0; j < checkboxes.length; j++) {
    if (checkboxes[j].checked) {
      checked = true;
      break;
    }
  }
  deleteButton.disabled = !checked;
}

// Listen for changes to the checkboxes and toggle the delete button accordingly
for (let i = 0; i < checkboxes.length; i++) {
  checkboxes[i].addEventListener('change', function() {
    toggleDeleteButton();
  });
}
</script>
<style>
.button-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 10vh; /* Set the height of the container to the full viewport height */
}

#buttonn {
  margin: 0 10px; /* Add some space between the buttons */
}
</style>
