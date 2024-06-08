<?php
include 'koneksi.php';
if (isset($_GET['idlaporan'])) {
    $idlaporan = intval($_GET['idlaporan']);
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
    <title>Pilih Petugas</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Reem+Kufi:wght@400..700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Crete+Round:ital@0;1&family=Libre+Baskerville:ital,wght@0,400;0,700&display=swap');
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
        .Container {
            margin: 75px;
        }
        .Container h1 {
            font-family: 'Crete Round', sans-serif;
            font-size: 24px;
            margin-bottom: 35px;
        }
        .Container table {
            width: 100%;
            text-align: center;
            padding-left: 100px;
            padding-right: 100px;
            border-collapse: collapse;
        }
        .Container table thead tr th {
            font-family: 'Reem Kufi', sans-serif;
        }
        td, th {
            font-family: 'Verdana', sans-serif;
            height: 30px;
            border-bottom: 1px solid;
        }
        td:nth-child(3) {
            font-family: 'Reem Kufi', sans-serif;
        }
        td a {
            color: black;
            transition: 0.3s ease-in-out;
            text-decoration: none;
            cursor: pointer;
        }
        td a.disabled {
            color: grey;
            cursor: not-allowed;
        }
        td a:hover:not(.disabled) {
            color: #fcc8d8;
            text-decoration: none;
            transition: 0.3s linear;
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
            background-color: rgba(0,0,0,0.5);
            z-index: 2;
            cursor: pointer;
        }
        .overlay-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .close-button {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #FFB6B6;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Reem Kufi', sans-serif;
            transition: 0.3s ease-in-out;
        }
        .close-button:hover {
            background-color: white;
            color: black;
            transition: 0.3s ease-in-out;
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
            <a href="comingsoon.php"><p>Logout</p></a>
        </div>
    </nav>
    <div class="Container">
        <center><h1>Pilih petugas tersedia yang paling dekat</h1></center>
        <center><table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Petugas</th>
                    <th>Nama Ketua</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $result = $conn->query("SELECT * FROM petugas");

                $row_number = 1; // Initialize the row number counter

                while($row = $result->fetch_assoc()) {
                    $availibility = $row['availibility'];
                    if ($availibility == 'Tersedia') {
                        echo "<tr>
                        <td>".$row_number."</td> 
                        <td>".htmlspecialchars($row['id'])."</td>
                        <td>".htmlspecialchars($row['username'])."</td>
                        <td>".htmlspecialchars($row['location'])."</td>
                        <td>".htmlspecialchars($row['availibility'])."</td>
                        <td><a href='#' class='action-link' data-id='".$row['id']."'>Kirim</a></td>
                        </tr>";
                    } else {
                        echo "<tr>
                        <td>".$row_number."</td> 
                        <td>".htmlspecialchars($row['id'])."</td>
                        <td>".htmlspecialchars($row['username'])."</td>
                        <td>".htmlspecialchars($row['location'])."</td>
                        <td>".htmlspecialchars($row['availibility'])."</td>
                        <td><a href='#' class='action-link disabled'>Kirim</a></td>";
                    }
                    $row_number++; // Increment the row number counter
                }
            ?>
            </tbody>
        </table></center>
    </div>

    <div class="overlay" id="overlay">
        <div class="overlay-content" id="overlay-content">
            <p>Loading...</p>
            <button class="close-button" id="close-button">Close</button>
        </div>
    </div>

    <script>
        document.querySelectorAll('.action-link').forEach(link => {
            link.addEventListener('click', function(event) {
                if (link.classList.contains('disabled')) {
                    event.preventDefault();
                } else {
                    event.preventDefault();
                    document.getElementById('overlay').style.display = 'block';
                    const petugasId = link.getAttribute('data-id');
                    const idlaporan = <?php echo $idlaporan; ?>;
                    
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'pending_request.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        const response = JSON.parse(this.responseText);
                        if (response.status === 'success') {
                            document.getElementById('overlay-content').innerHTML = '<p>' + response.message + '</p><button class="close-button" id="close-button">Close</button>';
                            document.getElementById('close-button').addEventListener('click', () => {
                                window.location.href = "LaporanAdmin.php";
                            });
                        } else {
                            document.getElementById('overlay-content').innerHTML = '<p>' + response.message + '</p><button class="close-button" id="close-button">Close</button>';
                            document.getElementById('close-button').addEventListener('click', () => {
                                document.getElementById('overlay').style.display = 'none';
                                document.getElementById('overlay-content').innerHTML = '<p>Loading...</p><button class="close-button" id="close-button">Close</button>';
                            });
                        }
                    };
                    xhr.send('idlaporan=' + idlaporan + '&idpetugas=' + petugasId);

                    // Periodically check the status
                    const intervalId = setInterval(() => {
                        const statusXhr = new XMLHttpRequest();
                        statusXhr.open('GET', 'check_status.php?idlaporan=' + idlaporan, true);
                        statusXhr.onload = function () {
                            const statusResponse = JSON.parse(this.responseText);
                            if (statusResponse.status === 'Diterima') {
                                clearInterval(intervalId);
                                document.getElementById('overlay-content').innerHTML = '<p>' + statusResponse.message + '</p><button class="close-button" id="close-button">Close</button>';
                                document.getElementById('close-button').addEventListener('click', () => {
                                    window.location.href = "LaporanAdmin.php";
                                });
                            } else {
                                document.getElementById('overlay-content').innerHTML = '<p>Petugas is receiving the report...</p><button class="close-button" id="close-button">Close</button>';
                            }
                        };
                        statusXhr.send();
                    }, 5000); // Check every 5 seconds
                }
            });
        });

        document.getElementById('close-button').addEventListener('click', () => {
            document.getElementById('overlay').style.display = 'none';
        });
    </script>
</body>
</html>
