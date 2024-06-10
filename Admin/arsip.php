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
$sql = "SELECT * FROM reports"; // Mengambil data dari tabel arsip
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Laporan</title>
    <style>
        @import url('https://fonts.cdnfonts.com/css/verdana');
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Reem+Kufi:wght@400..700&display=swap');

         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
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
        .nav {
            display: flex;
            padding-top: 15px;
            gap: 20px;
        }

        .nav a {
            text-decoration: none;
            color: black;
            font-size: 16px;
        }
        nav {
            display: flex;
            justify-content: space-between;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-right button {
            background-color: #ffcccc;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .header-right img {
            height: 30px;
        }
        .LeftHeader {
            display: inline-flex;
            float: left;
        } 
        .LeftHeader a img {
            height: 120px;
        } 

        .LeftHeader a {
            text-decoration: none;
            padding: 10px;
            padding-left: 30px;
            padding-right: 30px;
        } 

        .LeftHeader a p {
            margin-left: 20px;
            margin-top: 50px;
            font-size: 24px;
            font-family: 'Reem Kufi', sans-serif;
            color: black;
        } 

        .RightHeader img {
            height: 100px;
        }

        .RightHeader a {
            text-decoration: none;
            margin-right: 75px;
            padding-top: 25px;
            border-radius: 20px;
        } 
        .RightHeader a p {
            font-size: 24px;
            font-family: 'Reem Kufi', sans-serif;
            background-color: #FFB6B6;
            color: black; 
            padding: 10px;
            padding-left: 60px;
            padding-right: 60px;
            border-radius: 10px;
            transition: 0.3s ease-in-out;
        }
        .RightHeader a p:hover {
            background-color: white;
            transition: 0.3s ease-in-out;
        }

        .RightHeader img {
            margin-right: 20px;
            margin-top: 15px;
        } 

        .RightHeader {
            display: inline-flex;
        } 
    </style>
</head>
<body>
    <nav>
        <div class="LeftHeader">
            <a href="Dashboard_admin.html"><img src="Black Retro Car Repair Garage Logo_20240429_111254_0000.png" alt=""></a>
            <a href="verifikasi_admin.php"><p>Verifikasi</p></a>
            <a href="LaporanAdmin.php"><p>Laporan</p></a>
            <a href="arsip.php"><p>Arsip</p></a>
        </div>
        <div class="RightHeader">
            <a href="../logout.php"><p>Logout</p></a>
            <img src="alarm.png" alt="Alarm Icon">
        </div>
    </nav>

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
                    <th>No HP</th>
                    <th>Status</th>
                    <th>ID Petugas</th>
                    <th>Nama Petugas</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["idlaporan"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td><img src='" . $row["evidence_path"] . "' alt='Report Image' class='report-image'></td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>" . $row["idpetugas"] . "</td>";
                        echo "<td>" . $row["usernamepetugas"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>"; // Assuming 'tanggal' is the column name for the archive date
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
            window.location.href = "../logout.php";
        }
    </script>
</body>
</html>
