<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;
$data = json_decode(file_get_contents("php://input"), true);
$recepe_id = isset($data['recepe_id']) ? $data['recepe_id'] : null;

$response = array();

$response['admin_id'] = $admin_id; // Logowanie admin_id
$response['recepe_id'] = $recepe_id; // Logowanie recepe_id

if ($admin_id && $recepe_id) {
    $sql = "DELETE FROM favorites WHERE admin_id = ? AND recepe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $admin_id, $recepe_id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $stmt->error;
    }
    $stmt->close();
} else {
    $response['success'] = false;
    $response['error'] = 'Missing admin_id or recepe_id';
}

$conn->close();

echo json_encode($response);
?>
