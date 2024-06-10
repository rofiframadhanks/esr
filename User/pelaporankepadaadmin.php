<?php
session_start();
include '../koneksi.php';

$iduser = intval($_GET['iduser']);

if (!isset($_SESSION['login_user']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Incident Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            display: flex;
            height: 100vh;
        }
        .container {
            display: flex;
            width: 100%;
        }
        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
        }
        .image-section {
            flex: 1;
            background: linear-gradient(to right, #ffffff, #ff6347);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .image-section img {
            width: 100%;
        }
        .logo img {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
        h2 {
            color: #f30909;
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center;
        }
        .back-link {
            align-self: flex-start;
            margin-bottom: 20px;
            color: #f30909;
            text-decoration: none;
            font-weight: bold;
        }
        .form-group {
            width: 100%;
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }
        .submit-button {
            display: inline-block;
            width: calc(100% - 40px);
            padding: 10px 20px;
            background-color: #ff6347;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 25px;
            border: 2px solid #ff6347;
            transition: background-color 0.3s ease;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .submit-button:hover {
            background-color: #ff0000;
            border-color: #ff0000;
        }
        .right-side img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <a href="#" class="back-link">&lt; Back</a>
            <div class="logo">
                <img src="../Media/Black Retro Car Repair Garage Logo.png" alt="Logo">
            </div>
            <h2>Enter Data to Admin</h2>
            <form action="submit_report.php?iduser=<?php echo htmlspecialchars($iduser); ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="your full name" required>
                </div>
                <div class="form-group">
                    <label for="location">Location of the Incident</label>
                    <input type="text" id="location" name="location" placeholder="Location of the Incident" required>
                </div>
                <div class="form-group">
                    <label for="description">Description of the Incident</label>
                    <textarea id="description" name="description" placeholder="Description of the incident" required></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="your phone number" required>
                </div>
                <div class="form-group">
                    <label for="evidence">Supporting Evidence</label>
                    <input type="file" id="evidence" name="evidence" required>
                </div>
                <button type="submit" class="submit-button">Send to Admin</button>
            </form>
        </div>
        <div class="image-section">
            <img src="../Media/firefighter-99 (1).png" alt="Firefighter Image">
        </div>
    </div>
</body>
</html>
