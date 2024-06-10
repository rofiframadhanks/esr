<?php
session_start();
include('Koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST["name"]));
    $idcard = htmlspecialchars(trim($_POST["idcard"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(trim($_POST["password"]));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user_verif (id, username, phone, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $idcard, $name, $phone, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location: signupberhasil.html"); // Redirect to success page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
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
    .left-side {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #ffffff;
    }
    .right-side {
        flex: 1;
        background: linear-gradient(to right, #ffffff, #ff6347);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .left-side img {
        width: 100px;
        height: auto;
        margin-bottom: 20px;
    }
    h1 {
        color: #f30909;
        font-size: 36px;
        margin-bottom: 20px;
        text-align: center;
    }
    .back-link {
        align-self: flex-start;
        margin-bottom: 0px;
        color: #f30909;
        text-decoration: none;
        font-weight: bold;
    }
    .form-group {
        width: 100%;
        margin-bottom: 20px;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 5px;
    }
    .submit-button {
        display: inline-block;
        width: 100%;
        margin-bottom: 10%;
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
    .forgot-password {
        text-align: right;
        margin-top: -10px;
        margin-bottom: 20px;
        color: #ff6347;
        text-decoration: none;
    }
    .google-button {
        display: inline-block;
        width: 100%;
        padding: 10px 20px;
        background-color: #ffffff;
        color: #000;
        text-align: center;
        text-decoration: none;
        border-radius: 25px;
        border: 2px solid #ccc;
        transition: background-color 0.3s ease;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }
    .google-button:hover {
        background-color: #f1f1f1;
    }
    .right-side img {
        max-width: 100%;
        height: auto;
    }
</style>
</head>
<body>
<div class="container">
    <div class="left-side">
        <a href="start.html" class="back-link">&lt; Back</a>
        <img src="Media/logo.jpg" alt="Logo">
        <h1>Welcome!</h1>
        <form action="signup.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="your full name" required>
            </div>
            <div class="form-group">
                <label for="idcard">ID Card</label>
                <input type="text" id="idcard" name="idcard" placeholder="your id identity card" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="your phone number" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="your password" required>
            </div>

            <div>
                <button type="button" class="google-button">Sign-up with Google</button>
            </div>
            <div>
                <button type="submit" class="submit-button">Sign Up</button>
            </div>
            
        </form>
    </div>
    <div class="right-side">
        <img src="Media/firefighter-99 (1).png" alt="Firefighter Image">
    </div>
</div>
</body>
</html>

