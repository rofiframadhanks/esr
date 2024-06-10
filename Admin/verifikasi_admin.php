<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Report</title>
    <link rel="icon" href="Black Retro Car Repair Garage Logo_20240429_111254_0000.png">
    <style>
        @import url('https://fonts.cdnfonts.com/css/verdana');
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Reem+Kufi:wght@400..700&display=swap');

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .overlay-content {
            background-color: #ffd4d4;
            padding: 20px;
            border-radius: 34px;
            width: 400px;
            text-align: center;
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }

        .close-button,
        .submit-button {
            width: 188.41px;
            height: 39.1px;
            border: 1px transparent;
            border-radius: 10px;
            background-color: #fceaea;
        }

        .overlay.show {
            display: flex;
            opacity: 1;
        }

        .overlay.show .overlay-content {
            transform: scale(1);
        }

        .overlay.hide {
            display: flex;
            opacity: 0;
            transition: opacity 0.5s ease, display 0s linear 0.5s;
        }

        .overlay.hide .overlay-content {
            transform: scale(0.8);
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 50px;
            background-color: white;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-left img {
            height: 50px;
            margin-right: 20px;
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

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        table, th, td {
            border-bottom: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        td {
            font-family: 'Verdana', sans-serif;
        }

        th {
            font-family: 'Reem Kufi', sans-serif;
        }

        .status-icons {
            display: flex;
            gap: 10px;
        }

        .status-icons img {
            height: 20px;
            cursor: pointer;
        }

        .status-icons button {
            border: none;
            background: none;
        }

        .header-right a {
            padding: 15px;
            padding-left: 40px;
            padding-right: 40px;
            background-color: #FFB6B6;
            text-decoration: none;
            border-radius: 10px;
            font-size: 19px;
            color: black;
            font-family: 'Verdana', sans-serif;
        }
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

        .message-status-success {
            font-family: 'Verdana', sans-serif;
            font-size: 18px;
            color: black;
            /* margin: 10px; */
            text-align: center;
            background-color: #ffa3b2;
            /* margin: 5%; */
            margin-left: 30%;
            margin-right: 30%;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 100px;
            padding-right: 100px;
            /* border-radius: 5% 5% 5% 5% ; */
        }
        .message-status-error {
            font-family: 'Verdana', sans-serif;
            font-size: 18px;
            color: red;
            /* margin: 10px; */
            text-align: center;
            background: rgb(253, 188, 201);
            /* margin: 5%; */
            margin-left: 30%;
            margin-right: 30%;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 100px;
            padding-right: 100px;
            /* border-radius: 5% 5% 5% 5% ; */
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
            <img src="alarm.png" alt="Alarm Icon">
        </div>
    </nav>
    <table>
        <tr>
            <th>No</th>
            <th>ID Number</th>
            <th>Name</th>
            <th>No. Handphone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
            $result = $conn->query("SELECT * FROM user_verif");

            $row_number = 1; // Initialize the row number counter

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row_number."</td> 
                    <td>".$row['id']."</td>
                    <td>".$row['username']."</td>
                    <td>".$row['phone']."</td>
                    <td>".$row['email']."</td>
                    <td class='status-icons'>
                        <abbr title='Terima'><button class='openOverlay' data-overlay='overlay1'><img src='accept.png' alt='Check Icon'></button></abbr>
                        <abbr title='Tolak'><button class='openOverlay' data-overlay='overlay2'><img src='remove.png' alt='Cross Icon'></button></abbr>  
                    </td>
                </tr>";
                $row_number++; // Increment the row number counter
            }
        ?>
    </table>

    <div id="overlay1" class="overlay">
        <div class="overlay-content">
            <span class="close-button" data-overlay="overlay1">X</span>
            <h2>Setuju?</h2>
            <p>Apakah anda ingin menyetujui verifikasi pengguna ini?</p>
            <form method="post" action="submit.php">
                <input type="hidden" name="action" value="accept">
                <input type="hidden" name="user_id" id="acceptUserId">
                <button type="submit" class="submit-button">Iya</button>
                <button type="button" class="close-button" data-overlay="overlay1">Tidak</button>
            </form>
        </div>
    </div>

    <div id="overlay2" class="overlay">
        <div class="overlay-content">
            <span class="close-button" data-overlay="overlay2">X</span>
            <h2>Tolak</h2>
            <p>Apakah anda ingin menolak verifikasi pengguna ini?</p>
            <form method="post" action="submit.php">
                <input type="hidden" name="action" value="reject">
                <input type="hidden" name="user_id" id="rejectUserId">
                <button type="submit" class="submit-button">Iya</button>
                <button type="button" class="close-button" data-overlay="overlay2">Tidak</button>
            </form>
        </div>
    </div>

    <?php
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'success') {
                echo "<div class='message-status-success'>User berhasil Diverifikasi!</div>";
            } elseif ($status == 'error') {
                echo "<div class='message-status-error'>An error occurred. Please try again.</div>";
            } elseif ($status == 'error_user_not_found') {
                echo "<div class='message-status-error'>User not found.</div>";
            }
        }
    ?>
    <script>
        function openOverlay(overlayId) {
            const overlay = document.getElementById(overlayId);
            overlay.classList.remove('hide');
            overlay.classList.add('show');
        }

        function closeOverlay(overlayId) {
            const overlay = document.getElementById(overlayId);
            overlay.classList.remove('show');
            overlay.classList.add('hide');
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 500); 
        }

        document.querySelectorAll('.openOverlay').forEach(button => {
            button.addEventListener('click', function() {
                const overlayId = this.getAttribute('data-overlay');
                const userId = this.closest('tr').children[1].textContent;
                if (overlayId === 'overlay1') {
                    document.getElementById('acceptUserId').value = userId;
                } else if (overlayId === 'overlay2') {
                    document.getElementById('rejectUserId').value = userId;
                }
                const overlay = document.getElementById(overlayId);
                overlay.style.display = 'flex';
                setTimeout(() => openOverlay(overlayId), 10); 
            });
        });

        document.querySelectorAll('.close-button').forEach(button => {
            button.addEventListener('click', function() {
                const overlayId = this.getAttribute('data-overlay');
                closeOverlay(overlayId);
            });
        });

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('overlay')) {
                closeOverlay(event.target.id);
            }
        });
    </script>
</body>
</html>
