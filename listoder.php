<?php
header('Content-Type: application/json');

// Replace these with your own database credentials
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'password';
$db_name = 'database_name';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$userid = $data['userid'];

// Replace this with your own SQL query
$sql = "INSERT INTO orders (userid) VALUES ('$userid')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>