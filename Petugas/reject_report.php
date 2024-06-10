<?php
include 'koneksi.php';

$idlaporan = intval($_GET['idlaporan']);
$idpetugas = intval($_GET['idpetugas']);

$stmt = $conn->prepare("UPDATE reports SET status = 'Ditolak' WHERE idlaporan = ? AND idpetugas = ?");
$stmt->bind_param("ii", $idlaporan, $idpetugas);

if ($stmt->execute()) {
    header("Location: dashboard_petugas.php?idpetugas=$idpetugas");
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
