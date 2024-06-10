<?php
include 'koneksi.php';

$idpetugas = intval($_GET['idpetugas']);
$idlaporan = intval($_GET['idlaporan']);

$stmt = $conn->prepare("UPDATE reports SET status = 'Selesai' WHERE idlaporan = ? AND idpetugas = ?");
$stmt->bind_param("ii", $idlaporan, $idpetugas);

if ($stmt->execute()) {
    header("Location: melihat laporan.php?idpetugas=$idpetugas");
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
