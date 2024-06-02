<?php
// Podłącz do bazy danych
$servername = "localhost";
$username = "root";
$password = ""; // Domyślne hasło puste
$dbname = "login_db";

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pobierz ID zalogowanego użytkownika (admin_id)
session_start();
$admin_id = $_SESSION['admin_id'];

// Zapytanie do bazy danych
$sql = "SELECT recepe.*, 
        CASE 
          WHEN favorites.admin_id IS NOT NULL THEN 1 
          ELSE 0 
        END AS is_favorite 
        FROM recepe 
        LEFT JOIN favorites ON recepe.id = favorites.recepe_id AND favorites.admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

// Zwróć dane w formacie JSON
echo json_encode($data);
?>
