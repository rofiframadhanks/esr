<?php
include 'koneksi.php';

// Memeriksa apakah idlaporan ada di URL
if (isset($_GET['idlaporan'])) {
    $idlaporan = $_GET['idlaporan'];
    $stmt = $conn->prepare("SELECT * FROM reports WHERE idlaporan = ?");
    $stmt->bind_param("i", $idlaporan);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    echo "ID laporan tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <link rel="icon" href="Black Retro Car Repair Garage Logo_20240429_111254_0000.png">    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Reem+Kufi:wght@400..700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Crete+Round:ital@0;1&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap');
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
        .container {
            margin: 70px;
        } 
        table {
            background-color: #FFB6B6;
            width: 100%;
            font-size: 20px;
        }
        .container h1 {
            font-family: 'Crete Round', sans-serif;
            font-size: 24px;
            margin-left: 75px;
            margin-bottom: 30px;
        } 
        td {
            text-align: center;
        }
        thead {
            font-size: 24px;
            height: 70px;
            background-color: #ff4500;
        }
        tbody {
            height: 150px;
        }
        td img {
            height: 30px;
            margin: 5px;
            cursor: pointer;
        }
        .overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }
        .overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .overlay button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .confirm-button {
            background-color: #4CAF50;
            color: white;
        }
        .cancel-button {
            background-color: #f44336;
            color: white;
        }
        .gambar {
            width: 100%;
        }
    </style>
</head>
<body>
    <nav>
        <div class="LeftHeader">
            <a href="Dashboard_admin.html"><img src="Black Retro Car Repair Garage Logo_20240429_111254_0000.png" alt=""></a>
            <a href="verifikasi_admin.php"><p>Verifikasi</p></a>
            <a href="LaporanAdmin.php"><p>Laporan</p></a>
        </div>
        <div class="RightHeader">
            <a href="comingsoon.html"><p>Logout</p></a>
        </div>
    </nav>
    <div class="container">
        <h1>Report Data</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Laporan</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($row['idlaporan']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td>
                        <abbr title="Terima"><img src="accept.png" alt="Accept" onclick="showOverlay('accept', <?php echo $row['idlaporan']; ?>)"></abbr>
                        <abbr title="Tolak"><img src="remove.png" alt="Remove" onclick="showOverlay('remove', <?php echo $row['idlaporan']; ?>)"></abbr>
                    </td>
                </tr>
            </tbody>
        </table>
        <br><br><br>
        <center><img class="gambar" src="<?php echo htmlspecialchars($row['evidence_path']); ?>" alt=""></center>
    </div>

    <!-- Overlay for confirmation -->
    <div id="overlay" class="overlay">
        <div class="overlay-content">
            <p id="overlay-message"></p>
            <button class="confirm-button" onclick="confirmAction()">Confirm</button>
            <button class="cancel-button" onclick="closeOverlay()">Cancel</button>
        </div>
    </div>

    <script>
        let actionType = '';
        let reportId = '';

        function showOverlay(action, id) {
            actionType = action;
            reportId = id;
            const overlay = document.getElementById('overlay');
            const message = document.getElementById('overlay-message');
            if (action === 'accept') {
                message.textContent = 'Apakah anda yakin ingin menerima laporan ini?';
            } else if (action === 'remove') {
                message.textContent = 'Apakah anda yakin ingin menolak laporan ini?';
            }
            overlay.style.display = 'block';
        }

        function closeOverlay() {
            document.getElementById('overlay').style.display = 'none';
        }

        function confirmAction() {
            closeOverlay();
            if (actionType === 'accept') {
                window.location.href = "MemilihPetugas.php?idlaporan=" + reportId;
            } else if (actionType === 'remove') {
                window.location.href = "reject_laporan.php?idlaporan=" + reportId;
            }
        }
    </script>
</body>
</html>
