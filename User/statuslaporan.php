<?php
session_start();
include '../koneksi.php';

$iduser = intval($_GET['iduser']);

if (!isset($_SESSION['login_user']) || $_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit();
}

$result = $conn->query("SELECT * FROM reports WHERE iduser = $iduser ORDER BY idlaporan DESC LIMIT 1");

if (!$result) {
    die("Query failed: " . $conn->error);
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
        header img {
            height: 50px;
        }
        header nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
        }
        .contact {
            display: flex;
            align-items: center;
        }
        .contact button {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 10px;
            border-radius: 5px;
        }
        .content {
            text-align: center;
            padding: 20px;
        }
        .status {
            background-color: #ffe0e0;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .status .text {
            text-align: left;
            margin-right: 10px;
        }
        .status img {
            width: 300px;
        }
        .report {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .report .text {
            text-align: left;
            flex: 1;
            margin-right: 20px;
        }
        .report h3 {
            color: #333;
        }
        .report p {
            color: #4caf50;
            font-weight: bold;
        }
        .report span {
            display: block;
            color: #777;
            margin-top: 10px;
        }
        .map {
            width: 40%;
        }
        .map img {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <img src="../Media/logo.jpg" alt="Logo">
        <nav>
            <a href="https://www.detik.com/properti/tips-dan-panduan/d-7300234/7-tips-cegah-kebakaran-di-rumah-penting-dicatat">Tips</a>
            <a href="faq.html">FAQ</a>
        </nav>
        <div class="contact">
            <span>+62 8xxxxxxxx</span>
            <a href="homepageuser.php"><button>Home</button></a>
        </div>
    </header>
    <div class="content">
        <div class="status">
            <div class="text">
                <h2>Hi, User</h2>
                <p>Ready to see your report status?</p>
            </div>
            <img src="../Media/fire_truck_vector-removebg-preview.png" alt="Fire Truck">
        </div>
        <div class="report">
            <div class="text">
                <h3>Laporan Anda</h3>
                <?php 
                if ($row) {
                    echo "<p id='report-status'>ID Laporan = " . $row['idlaporan'] . "</p>";
                    if ($row['status'] == "Menunggu Diverifikasi") {
                        echo "<p id='report-status'>Laporan anda sedang diproses</p>";
                    } elseif ($row['status'] == "Diterima") {
                        echo "<p id='report-status'>Laporan anda telah diterima oleh petugas dari satuan " . $row['idpetugas'] . " yang bernama " . $row['usernamepetugas'] . "</p>";
                    } elseif ($row['status'] == "Pending") {
                        echo "<p id='report-status'>Laporan anda Sedang diajukan ke petugas terkait</p>";
                    }
                    // echo "<span>Sekarang petugas DAMKAR sedang menuju lokasi TKP</span>";
                } else {
                    echo "<p id='report-status'>Tidak ada laporan yang ditemukan.</p>";
                }
                ?>
            </div>
            <div class="map">
                <img src="../Media/Screenshot 2024-06-03 172018.png" alt="Map">
            </div>
        </div>
    </div>
    <script>
        // You can use this script to update the report status dynamically
        function updateReportStatus(status) {
            document.getElementById('report-status').innerText = status;
        }
    </script>
</body>
</html>
