// Open the CSV file
if (($handle = fopen("scores.csv", "r")) !== FALSE) {
    // Loop through each row in the CSV file
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Retrieve the full name from the CSV
        $full_name = $data[0];

        // Retrieve the corresponding user ID from the database
        $query = "SELECT user_id FROM users WHERE full_name = '$full_name'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];

        // Save the score information in the score_info table
        $score = $data[1];
        $query = "INSERT INTO score_info (user_id, score) VALUES ('$user_id', '$score')";
        mysqli_query($conn, $query);
    }

    // Close the CSV file
    fclose($handle);
}

//csv

i have 60 rows containing student name, 4 input boxes for first ca, second ca, third ca and exam score and each row has a submit button to save inputs into the database but i don't want the whole page to reload when the submit button is clicked. Also i want the table rows to keep reducing as the submit button is clicked and inputs have been save.

$(document).ready(function() {
  // Listen for click event on submit button
  $('.submit-row').on('click', function(e) {
    e.preventDefault();

    // Get row ID and input values
    var rowId = $(this).data('row-id');
    var ca1 = $('input[name="ca1"]', '#' + rowId).val();
    var ca2 = $('input[name="ca2"]', '#' + rowId).val();
    var ca3 = $('input[name="ca3"]', '#' + rowId).val();
    var exam = $('input[name="exam"]', '#' + rowId).val();

    // Send data to server using AJAX
    $.ajax({
      url: 'submit-form.php',
      method: 'POST',
      data: {
        rowId: rowId,
        ca1: ca1,
        ca2: ca2,
        ca3: ca3,
        exam: exam
      },
      success: function(response) {
        // Update table row with new data
        $('#' + rowId).html(response);

        // Remove row from table
        $('#' + rowId).fadeOut('slow', function() {
          $(this).remove();
        });
      },
      error: function() {
        alert('An error occurred while submitting the form.');
      }
    });
  });
});
