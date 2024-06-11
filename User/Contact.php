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
    <title>My Contact</title>
    <link rel="stylesheet" href="Contact.css">
</head>

<body>

    <section>
        <header>
            <img class="logo" src="../Media/logo.jpg" alt="logo">
            <nav>
                <ul class="nav">
                    <li><a href="https://www.detik.com/properti/tips-dan-panduan/d-7300234/7-tips-cegah-kebakaran-di-rumah-penting-dicatat">Tips</a></li>
                    <li><a href="About.html">Status</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>
            </nav>
    
            <a class="cta" href="../homepageuser.php?iduser=<?php echo htmlspecialchars($iduser); ?>">
                <Button> Home </Button>
            </a>
        </header>
    </section>

    <section>
        <div class="contact">
            <img src="../Media/logo2.png" class="pic" alt="Personal Pic">
        </div>

        <div class="keterangan">
            <img src="../Media/mail.png" alt="email"> <p>esrindonesia123@gmail.com</p>
            <img src="../Media/call.png" alt="telphone"> <p>+62 8957042xxxx</p>
            <img src="../Media/instagram.png" alt="ig"> <p>@ESRIndonesia</p>
        </div>
    </section>
    
</body>
</html>