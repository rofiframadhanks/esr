<?php
// Buat koneksi ke database
$servername = "localhost"; // Ganti dengan hostname Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "efrrr"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM reports";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan diproses</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            text-decoration: none;
            color: black;
            margin: 0 10px;
            font-weight: bold;
        }
        .logout {
            background-color: #ff6666;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            color: white;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #ff7f00;
            color: white;
            font-size: 18px;
        }
        td {
            font-size: 16px;
        }
        .report-image {
            width: 100px;
            height: auto;
        }
        .logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }
        .header-section {
            display: flex;
            align-items: center;
        }
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .action-buttons button {
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            color: white;
        }
        .action-buttons .process {
            background-color: #6666ff;
        }
        .action-buttons .select {
            background-color: #9966cc;
        }
        .popup, .overlay {
            display: none;
        }
        .popup-content, .popup-tindakan-content {
            background-color: #f8d7da;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .popup-tindakan-content {
            background-color: #f8d7da;
        }
        .popup-tindakan-content p, .popup-tindakan-content h2 {
            margin-bottom: 20px;
        }
        .popup-tindakan-content button {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #721c24;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 0 10px;
            cursor: pointer;
        }
        .popup-tindakan-content button:hover {
            background-color: #f8d7da;
        }
        .popup, .overlay {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }
        .popup-content {
            position: relative;
            z-index: 1001;
        }
        .icon {
            width: 50px;
            height: 50px;
            background-color: #f56c6c;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            color: white;
            margin: 0 auto;
            position: relative;
            top: -25px;
        }
        .popup-content h2, .popup-tindakan-content h2 {
            margin-top: 0;
            color: #721c24;
        }
        .popup-content button {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #721c24;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="header-section">
            <a href="melihat laporan.html">
                <img src="Black Retro Car Repair Garage Logo.png" alt="Logo" class="logo">
            </a>
            <a href="#">Laporan</a>
            <a href="arsip.php">Arsip</a>
        </div>
        <button class="logout" onclick="logout()">Logout</button>

    </div>

    <div class="container">
        <h2>Report Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>No HP</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td><img src='" . $row["evidence_path"] . "' alt='Report Image' class='report-image'></td>";
                        echo "<td>";
                        echo "<div class='action-buttons'>";
                        echo "<button class='process' onclick='showTindakanPopup()'>Di Proses</button>";
                        echo "<button class='select' onclick='showPopup()'>Selesai</button>";
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data yang ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <div class="icon">❓</div>
            <h2>Apakah pekerjaan terselesaikan?</h2>
            <button onclick="handleYes()">Ya</button>
            <button onclick="hidePopup()">Tidak</button>
        </div>
    </div>

    <script>
        function logout() {
    // Redirect user to start.html
    window.location.href = "start.html";
}

        document.addEventListener("DOMContentLoaded", function() {
            // Initially hide popups and overlay
            document.getElementById('popup').style.display = 'none';
            document.getElementById('popup-tindakan').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        });

        function showPopup() {
            // Show popup and overlay
            document.getElementById('popup').style.display = 'flex';
            document.getElementById('overlay').style.display = 'block';
        }

        function hidePopup() {
            // Hide popup and overlay
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function showTindakanPopup() {
            // Show tindakan popup and overlay
            document.getElementById('popup-tindakan').style.display = 'flex';
            document.getElementById('overlay').style.display = 'block';
        }

        function hideTindakanPopup() {
            // Hide tindakan popup and overlay
            document.getElementById('popup-tindakan').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function handleYes() {
            // Redirect user to appropriate page
            window.location.href = "arsip.php";

            // Hide tindakan popup after redirecting
            hideTindakanPopup();
        }
    </script>
</body>
</html>
