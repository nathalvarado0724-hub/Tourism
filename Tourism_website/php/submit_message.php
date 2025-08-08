<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$database = "register_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize POST data
$userName = $conn->real_escape_string($_POST['name']); // Fixed
$useremail = $conn->real_escape_string($_POST['email']);
$usermessage = $conn->real_escape_string($_POST['message']);

// Insert into database
$sql = "INSERT INTO logindb (userName, useremail, usermessage) 
        VALUES ('$userName', '$useremail', '$usermessage')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Message sent successfully!');
        window.location.href = 'contact.php';
    </script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
