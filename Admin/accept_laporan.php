<?php
include 'koneksi.php';

if (isset($_GET['idlaporan'])) {
    $idlaporan = $_GET['idlaporan'];
    // Logika untuk menerima laporan
    // Mungkin Anda ingin mengupdate status laporan di database
    $stmt = $conn->prepare("UPDATE laporan SET status = 'Diterima' WHERE idlaporan = ?");
    $stmt->bind_param("i", $idlaporan);
    $stmt->execute();

    header("Location: MemilihPetugas.html");
    exit();
} else {
    echo "ID laporan tidak ditemukan.";
    exit();
}
?>
