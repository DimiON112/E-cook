<?php
session_start();
$servername = "localhost";  // Nazwa serwera bazy danych
$username = "root";         // Nazwa użytkownika bazy danych
$password = "";             // Hasło do bazy danych
$dbname = "login_db";       // Nazwa bazy danych

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if ($admin_id) {
    $sql = "SELECT recepe.* FROM favorites JOIN recepe ON favorites.recepe_id = recepe.id WHERE favorites.admin_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $favorites = array();
    while ($row = $result->fetch_assoc()) {
        $favorites[] = $row;
    }
    $stmt->close();
    $conn->close();

    echo json_encode($favorites);
} else {
    echo json_encode(array("error" => "User not logged in"));
}
?>
