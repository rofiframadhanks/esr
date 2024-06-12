<?php
include 'koneksi.php';

// Validate and sanitize input
$idpetugas = intval($_GET['idpetugas']);
$idlaporan = intval($_GET['idlaporan']);

// Check if the inputs are valid
if ($idpetugas > 0 && $idlaporan > 0) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE reports SET status = 'Selesai' WHERE idlaporan = ? AND idpetugas = ?");
    
    // Bind parameters
    $stmt->bind_param("ii", $idlaporan, $idpetugas);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        // Redirect to the specific page with a success message
        header("Location: melihat laporan.php?idpetugas=$idpetugas&status=success");
    } else {
        // Display an error message
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid input.";
}

// Close the connection
$conn->close();
?>
