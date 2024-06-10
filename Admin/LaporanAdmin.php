<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['login_user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$result = $conn->query("SELECT * FROM reports ORDER BY idlaporan DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="icon" href="Black Retro Car Repair Garage Logo_20240429_111254_0000.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Reem+Kufi:wght@400..700&display=swap');

        nav {
            display: flex;
            justify-content: space-between;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #FF4500;
            text-align: left;
            color: white;
            font-size: 24px;
            height: 50px;
            text-align: center;

        }

        tbody {
            background-color: #ffefd5;
            color: black;
            border-bottom: 2px solid #ffefd5;
            font-size: 24px;
            text-align: center;

        }

        .container {
            /* background-color: black; */
            margin: 100px;
            /* padding: 100px; */
            
        } 
        .container h1 {
            margin-left: 100px;
        } 
        td a {
            color: black;
            transition: 0.3s ease-in-out;
            text-decoration: none;
        }
        td a:hover {
            color: #fcc8d8;
            text-decoration: none;
            transition: 0.3s linear;
        }
        tr {
            height: 50px;
        }
        tr:nth-child(even){
            background-color: #e9967a;
        }
    </style>
</head>
<body>
    <nav>
        <div class="LeftHeader">
            <a href="Dashboard_admin.html"><img src="Black Retro Car Repair Garage Logo_20240429_111254_0000.png" alt=""></a>
            <a href="verifikasi_admin.php"><p>Verifikasi</p></a>
            <a href="LaporanAdmin.php"><p>Laporan</p></a>
            <a href="Arsip.php"><p>Arsip</p></a>
        </div>
        <div class="RightHeader">
            <a href="../logout.php"><p>Logout</p></a>
            <!-- <img src="alarm.png" alt="Alarm Icon"> -->
        </div>
    </nav>

    <div class="container">
        <h1>Report Data</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Laporan</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kejadian</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nomer = 1;
                    $result = $conn->query("SELECT * FROM reports Where status = 'Menunggu Diverifikasi'");

                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>".$nomer."</td>
                            <td>".$row['idlaporan']."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['location']."</td>
                            <td>".$row['description']."</td>
                            <td>".$row['phone']."</td>
                            <td><a href='DetailLaporanAdmin2.php?idlaporan=".$row['idlaporan']."'>Lihat Selengkapnya</a></td>
                        </tr>";
                        $nomer++;
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
