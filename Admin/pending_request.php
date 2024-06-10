<?php
include '../koneksi.php';

if (isset($_POST['idlaporan']) && isset($_POST['idpetugas'])) {
    $idlaporan = intval($_POST['idlaporan']);
    $idpetugas = intval($_POST['idpetugas']);

    $stmt = $conn->prepare("UPDATE reports SET idpetugas = ?, status = 'Pending' WHERE idlaporan = ?");
    $stmt->bind_param("ii", $idpetugas, $idlaporan);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Laporan berhasil dikirim."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal mengupdate laporan."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "ID laporan atau ID petugas tidak ditemukan."]);
}

$conn->close();
?>
