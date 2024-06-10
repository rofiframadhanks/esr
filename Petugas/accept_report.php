<?php
include 'koneksi.php';

$idlaporan = intval($_GET['idlaporan']);
$idpetugas = intval($_GET['idpetugas']);

$stmt = $conn->prepare("UPDATE reports SET status = 'Diterima' WHERE idlaporan = ? AND idpetugas = ?");
$stmt->bind_param("ii", $idlaporan, $idpetugas);

if ($stmt->execute()) {
    header("Location: melihat laporan diproses.php?idpetugas=$idpetugas&idlaporan=$idlaporan");
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
