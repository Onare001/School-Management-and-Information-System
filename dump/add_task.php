<?php
// Get the USSD input from the form
$ussdString = $_POST['ussdString'];

// Process the USSD input and generate a response
$response = processUssdInput($ussdString);

// Display the response
echo $response;

// Function to process the USSD input and generate a response
function processUssdInput($input) {
    // Determine the user's menu selection based on the input
    $selection = trim($input);

    // Handle the user's menu selection and generate a response
    switch ($selection) {
        case "":
            // Initial menu
            $response = "CON Welcome to My USSD App\n";
            $response .= "1. Check Balance\n";
            $response .= "2. Buy Airtime\n";
            $response .= "3. Exit";
            break;

        case "1":
            // Check balance menu
            $response = "CON Your balance is \$100\n";
            $response .= "Press 0 to go back";
            break;

        case "2":
            // Buy airtime menu
            $response = "CON Enter amount:";
            break;

        case "3":
            // Exit menu
            $response = "END Thank you for using My USSD App.";
            break;

        default:
            // Handle invalid input
            $response = "END Invalid input. Please try again.";
            break;
    }

    return $response;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>USSD Application</title>
</head>
<body>
    <h1>Welcome to My USSD App</h1>
    <form action="" method="post">
        <label for="ussdString">Enter USSD Input:</label>
        <input type="text" name="ussdString" id="ussdString" required>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

