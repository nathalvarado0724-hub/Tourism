<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "register_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// Only allow login for the specific admin
$sql = "SELECT * FROM user_admin WHERE userName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Use password_verify to check hashed password
    if (password_verify($password, $user['userPass'])) {
        // Login successful
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $user['userName'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Admin user not found'); window.location.href='index.php';</script>";
}

$stmt->close();
$conn->close();
?>
