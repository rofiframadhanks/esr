<?php
session_start();
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $id = $row['id'];
            $_SESSION['login_user'] = $email;
            $_SESSION['role'] = $row['role'];
            
            // Redirect based on user role
            if ($row['role'] == 'admin') {
                header("Location: admin/dashboard_admin.html"); // Redirect to admin dashboard
            } else if ($row['role'] == 'user') {
                header("Location: homepageuser.php?iduser=$id"); // Redirect to petugas homepage
            } else {
                header("Location: petugas/melihat%20laporan.php?idpetugas=$id"); // Redirect to user homepage
            }
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
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
        margin-bottom: 20px;
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
    .signup-link {
        margin-top: 20px;
        font-size: 14px;
    }
    .signup-link a {
        color: #ff6347;
        text-decoration: none;
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
        <h1>Welcome Back!</h1>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="your password" required>
            </div>
            <a href="#" class="forgot-password">Forgot Password?</a>
            <div>
                <button type="button" class="google-button">Login with Google</button>
            </div>
            <div>
                <button type="submit" class="submit-button">Login</button>
            </div>
        </form>
        <div class="signup-link">
            Don't have an account yet? <a href="signup.php">Sign Up</a>
        </div>
    </div>
    <div class="right-side">
        <img src="Media/firefighter-99 (1).png" alt="Firefighter Image">
    </div>
</div>
</body>
</html>

