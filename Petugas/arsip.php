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

// Fetch archived reports from the database
$sql = "SELECT * FROM arsip"; // Mengambil data dari tabel arsip
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Laporan</title>
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
    </style>
</head>
<body>
    <div class="navbar">
        <div class="header-section">
            <a href="melihat laporan.html">
                <img src="Black Retro Car Repair Garage Logo.png" alt="Logo" class="logo">
            </a>
            <a href="melihat laporan.html">Laporan</a>
            <a href="arsip.php">Arsip</a>
        </div>
        <button class="logout" onclick="logout()">Logout</button>
    </div>

    <div class="container">
        <h2>Data Arsip Laporan</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>No HP</th>
                    <th>Foto</th>
                    <th>Tanggal</th>
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
                        echo "<td>" . $row["tanggal"] . "</td>"; // Assuming 'tanggal' is the column name for the archive date
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data yang ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function logout() {
            // Redirect user to start.html
            window.location.href = "start.html";
        }
    </script>
</body>
</html>
