<?php
include 'koneksi.php';

$idpetugas = intval($_GET['idpetugas']);

$result = $conn->query("SELECT * FROM reports WHERE idpetugas = $idpetugas AND status = 'Pending'");

$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

echo json_encode($requests);
?>
