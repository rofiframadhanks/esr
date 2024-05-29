<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $evidence_path = '';

    // Handle file upload
    if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $evidence_path = $target_dir . basename($_FILES["evidence"]["name"]);
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $evidence_path)) {
            echo "The file ". basename($_FILES["evidence"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO reports (name, location, description, phone, evidence_path) VALUES ('$name', '$location', '$description', '$phone', '$evidence_path')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
