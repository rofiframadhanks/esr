<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "efrrr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute the query and check for errors
$sql = "SELECT name, location, description, phone, evidence_path FROM reports";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        header {
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header img {
            height: 50px;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .logout {
            background-color: #f8b4b4;
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
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
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
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions img {
            cursor: pointer;
            width: 20px;
            height: 20px;
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
    <script>
        function handleAction(action, phone) {
            if (action === 'remove') {
                if (confirm("Are you sure you want to delete this report?")) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "delete_report.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            alert(xhr.responseText);
                            location.reload();
                        }
                    };
                    xhr.send("phone=" + phone);
                }
            }
        }
    </script>
</head>
<body>
    <header>
        <div class="header-section">
            <img src="Black Retro Car Repair Garage Logo.png" alt="Logo" class="logo">
            <nav>
                <a href="verifikasi_admin.php">Verification</a>
                <a href="LaporanAdmin.php">Report</a>
                <a href="Arsip.php">Report</a>
            </nav>
        </div>
        <button class="logout" onclick="logout()">Logout</button>
    </header>
    <div class="container">
        <h2>Report Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                    <img src="" alt="">
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["name"], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row["location"], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo '<td class="actions">
                                <img src="accept 1.png" alt="Approve" data-phone="' . htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8') . '">
                                <img src="remove.png" alt="Reject" data-phone="' . htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8') . '" onclick="handleAction(\'remove\', \'' . htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8') . '\')">
                              </td>';
                        echo "</tr>";
                        echo "<img src='.htmlspecialchars($row["evidence_path"], ENT_QUOTES, 'UTF-8')' alt='Evidence Photo'>"
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        if ($result->num_rows > 0) {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            echo '<img src="' . htmlspecialchars($row["evidence_path"], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($row["description"], ENT_QUOTES, 'UTF-8') . '" class="report-image">';
        }
        ?>
    </div>

    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <div class="popup-content">
            <div class="icon">✖️</div>
            <h2>Tindakan Tidak valid !!!</h2>
            <button onclick="hidePopup()">Ok</button>
        </div>
    </div>

    <div class="popup" id="popup-tindakan">
        <div class="popup-tindakan-content">
            <div class="icon">❓</div>
            <h2>Konfirmasi Tindakan</h2>
            <p>Apakah anda akan menuju lokasi?</p>
            <button onclick="handleYes()">Ya</button>
            <button onclick="hideTindakanPopup()">Batal</button>
        </div>
    </div>

    <script>
        function logout() {
            // Redirect user to start.html
            window.location.href = "logout.php";
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
            window.location.href = "melihat laporan diproses.php";

            // Hide tindakan popup after redirecting
            hideTindakanPopup();
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
