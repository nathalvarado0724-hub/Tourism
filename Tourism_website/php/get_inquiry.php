<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $conn = new mysqli("localhost", "root", "", "register_db");

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(["error" => "Database connection failed"]);
        exit;
    }

    $id = intval($_POST['id']);
    $stmt = $conn->prepare("SELECT userName, useremail, userdate, usermessage FROM logindb WHERE userid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($data = $result->fetch_assoc()) {
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Inquiry not found"]);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo json_encode(["error" => "Invalid request"]);
}
?>

