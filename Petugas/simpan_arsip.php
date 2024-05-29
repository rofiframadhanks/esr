<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "efrrr";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $evidence_path = $_POST['evidence_path'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO arsip (name, location, description, phone, evidence_path, date)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $location, $description, $phone, $evidence_path, $date);

    if ($stmt->execute()) {
        $delete_sql = "DELETE FROM reports WHERE name = ? AND location = ? AND description = ? AND phone = ? AND evidence_path = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("sssss", $name, $location, $description, $phone, $evidence_path);
        $delete_stmt->execute();

        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>
