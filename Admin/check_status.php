<?php
include 'koneksi.php';

if (isset($_GET['idlaporan'])) {
    $idlaporan = intval($_GET['idlaporan']);

    // Prepare and execute the query to get the status of the report
    $stmt = $conn->prepare("SELECT status FROM reports WHERE idlaporan = ?");
    $stmt->bind_param("i", $idlaporan);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the report exists and fetch the status
    if ($row = $result->fetch_assoc()) {
        $status = $row['status'];
        
        // Prepare the response based on the status
        $response = [
            'status' => $status,
            'message' => ($status === 'Diterima') ? 'Request has been completed.' : 'Request is still pending.'
        ];
        
        echo json_encode($response);
    } else {
        // Handle case where the report is not found
        echo json_encode([
            'status' => 'error',
            'message' => 'Report not found.'
        ]);
    }
} else {
    // Handle case where idlaporan is not provided
    echo json_encode([
        'status' => 'error',
        'message' => 'ID laporan tidak ditemukan.'
    ]);
}
?>
