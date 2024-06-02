<?php
include 'koneksi.php';

if (isset($_GET['idlaporan'])) {
    $idlaporan = $_GET['idlaporan'];
    // Logika untuk menghapus laporan dari database
    $stmt = $conn->prepare("UPDATE FROM laporan SET status = 'Ditolak' WHERE idlaporan = ?");
    $stmt->bind_param("i", $idlaporan);
    $stmt->execute();

    header("Location: LaporanAdmin.php");
    exit();
} else {
    echo "ID laporan tidak ditemukan.";
    exit();
}
?>
