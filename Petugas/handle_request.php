<?php
include 'koneksi.php';

$idlaporan = intval($_POST['idlaporan']);
$action = $_POST['action'];
$idpetugas = intval($_POST['idpetugas']);

$status = ($action === 'accept') ? 'Diterima' : 'Ditolak';

$stmt = $conn->prepare("UPDATE reports SET status = ? WHERE idlaporan = ? AND idpetugas = ?");
$stmt->bind_param("sii", $status, $idlaporan, $idpetugas);

if ($stmt->execute()) {
    echo "Report $action successfully.";
} else {
    echo "Failed to $action report: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
