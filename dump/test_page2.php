<!DOCTYPE html>
<html>
<head>
    <title>Student ID</title>
</head>
<body>
    <input type="text" id="studentID" oninput="formatStudentID()">
SMS1/JS924A/003
    
    <script>
function formatStudentID() {
    let input = document.getElementById('studentID');
    let value = input.value.replace(/\W/g, ''); // Remove non-word characters

    if (value.length > 5 && value.length < 14) {
        value = value.replace(/(\w{4})(\w{3})/, "$1/$2"); // Insert "/" after the initial 5 characters
    }

    input.value = value;
}

    </script>
</body>
</html>
