<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login_user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$result = $conn->query("SELECT * FROM reports WHERE status = 'Approved' AND acknowledged_by_admin = 0");

if (!$result) {
    die("Query failed: " . $conn->error);
}

$approvedReports = [];
while ($row = $result->fetch_assoc()) {
    $approvedReports[] = $row;
}

// Mark reports as acknowledged to avoid duplicate notifications
$conn->query("UPDATE reports SET acknowledged_by_admin = 1 WHERE status = 'Approved' AND acknowledged_by_admin = 0");

echo json_encode($approvedReports);
?>
