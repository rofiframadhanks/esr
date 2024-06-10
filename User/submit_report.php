<?php
include '../koneksi.php';

$iduser = intval($_GET['iduser']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $evidence_path = '';

    // Handle file upload
    if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        $evidence_path = $target_dir . basename($_FILES["evidence"]["name"]);
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $evidence_path)) {
            echo "<center>The file ". basename($_FILES["evidence"]["name"]). " has been uploaded.</center>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO reports (name, location, description, phone, evidence_path, iduser) VALUES ('$name', '$location', '$description', '$phone', '$evidence_path', '$iduser')";

    if ($conn->query($sql) === TRUE) {
        echo "<center>New record created successfully<center>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    echo "<center><a href='../homepageuser.php?iduser=" . htmlspecialchars($iduser) . "'><button>Kembali ke Dashboard</button></a></center>";
    $conn->close();
}
?>
