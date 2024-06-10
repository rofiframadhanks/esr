<?php
session_start();
include '../koneksi.php';

$idpetugas = intval($_GET['idpetugas']);

if (!isset($_SESSION['login_user']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../login.php");
    exit();
}

$result = $conn->query("SELECT * FROM reports WHERE idpetugas = $idpetugas AND status = 'Pending'");

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .notification {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .notification p {
            margin: 0 0 10px;
        }
        .notification button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }
        .notification button.accept {
            background-color: #28a745;
            color: #fff;
        }
        .notification button.reject {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pending Reports</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Laporan</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idlaporan']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <a href="accept_report.php?idlaporan=<?php echo $row['idlaporan']; ?>&idpetugas=<?php echo $idpetugas; ?>">Terima</a>
                                <a href="reject_report.php?idlaporan=<?php echo $row['idlaporan']; ?>&idpetugas=<?php echo $idpetugas; ?>">Tolak</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No pending reports.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div id="notifications"></div>
    </div>

    <script>
        function checkForRequests() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'check_requests.php?idpetugas=<?php echo $idpetugas; ?>', true);
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    document.getElementById('notifications').innerHTML = '';
                    response.forEach(request => {
                        const notification = document.createElement('div');
                        notification.className = 'notification';
                        notification.innerHTML = `
                            <p>New request for report ID: ${request.idlaporan}</p>
                            <button class="accept" onclick="handleRequest(${request.idlaporan}, 'accept')">Accept</button>
                            <button class="reject" onclick="handleRequest(${request.idlaporan}, 'reject')">Reject</button>
                        `;
                        document.getElementById('notifications').appendChild(notification);
                    });
                } else {
                    console.error("Failed to fetch requests:", this.statusText);
                }
            };
            xhr.onerror = function () {
                console.error("Request error:", this.statusText);
            };
            xhr.send();
        }

        function handleRequest(reportId, action) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'handle_request.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status === 200) {
                    alert(this.responseText);
                    checkForRequests();
                } else {
                    console.error("Failed to handle request:", this.statusText);
                }
            };
            xhr.onerror = function () {
                console.error("Request error:", this.statusText);
            };
            xhr.send(`idlaporan=${reportId}&action=${action}&idpetugas=<?php echo $idpetugas; ?>`);
        }

        setInterval(checkForRequests, 5000); // Poll every 5 seconds
        checkForRequests(); // Initial check
    </script>
</body>
</html>
