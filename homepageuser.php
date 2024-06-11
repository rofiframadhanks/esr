<?php
session_start();
include 'koneksi.php';

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
    <title>Emergency Fire Response</title>
    <link rel="stylesheet" href="homepageuser.css">
</head>
<body>
    <header>
            <img class="logo" src="Media/logo.jpg" alt="logo">
            <nav>
                <ul class="nav">
                    <li><a href="https://www.detik.com/properti/tips-dan-panduan/d-7300234/7-tips-cegah-kebakaran-di-rumah-penting-dicatat">Tips</a></li>
                    <li><a href="user/statuslaporan.php?iduser=<?php echo htmlspecialchars($iduser); ?>">Status</a></li>
                    <li><a href="user/faq.html">FAQ</a></li>
                </ul>
            </nav>

            <div class="contact">
                <a href="user/chatuser.html" class="contact-message"><img src="Media/message.png" alt="Pesan"></a>
                <a href="tel:+62xxxxxxxx" class="contact-phone"><p>+62 xxxxxxxx</p></a>
                <a class="cta" href="user/Contact.php?iduser=<?php echo htmlspecialchars($iduser); ?>">
                    <Button> Contact</Button>
                </a>
            </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-text">
                <h1>Emergency Fire Response</h1>
                <p>Berikut ada beberapa alat yang bisa digunakan untuk pertolongan pertama jika terdapat indikasi kebakaran</p>
            </div>
            <div class="hero-images">
                <img src="Media/gambar1.png" alt="Fire Extinguisher">
            </div>
        </section>

        <section class="fire-tools">
            <div class="tool">
                <img src="Media/image1.png" alt="Fire Extinguisher">
                <p>Fire Extinguisher</p>
            </div>
            <div class="tool">
                <img src="Media/image2.png" alt="Fire Alarm">
                <p>Fire Alarm</p>
            </div>
            <div class="tool">
                <img src="Media/image3.png" alt="Fire Hydrant">
                <p>Fire Hydrant</p>
            </div>
        </section>

        <section class="about">
        <div class="gambarpetugas">
            <img src="Media/image.png" alt="Firefighters">
        </div>
        <div class="textpetugas">
            <h2>Learn More About Our Firebrig</h2>
            <div class="about-petugas">
                <ul>
                    <li>Work as a team</li>
                    <li>Follow Instructions</li>
                    <li>Safety is priority</li>
                    <li>Leave no man behind</li>
                    <li>Better Communication</li>
                </ul>
            </div>
            <div class="about-stats">
                <img src="Media/stats.png" alt="Stats">
                <p>Always on Time Arrival</p>
            </div>
            <div class="about-actions">
                <a href="user/pelaporankepadaadmin.php?iduser=<?php echo htmlspecialchars($iduser); ?>" class="report-btn">Make A Report</a>
                <a href="user/chatuser.html" class="consult-btn">Consult Now</a>
            </div>
        </div>
    </section>

        <section class="news">
            <div class="news-ourtips">
                <p>Our Blog</p>
            </div>
            <h2>News & Tips</h2>
            <div class="news-items">
                <div class="news-item">
                    <img src="Media/berita1.png" alt="News 1">
                    <a href="https://www.detik.com/properti/tips-dan-panduan/d-7300234/7-tips-cegah-kebakaran-di-rumah-penting-dicatat"><p>Tips untuk emergency jika terjadi indikasi <br>terjadinya kebakaran</p></a>
                </div>
                <div class="news-item">
                    <img src="Media/berita2.png" alt="News 2">
                    <a href="https://20.detik.com/detikupdate/20240505-240505068/ruko-di-jakbar-terbakar-13-damkar-dan-55-personel-dikerahkan"><p>Ruko di Jakbar Terbakar, 13 Damkar dan <br>55 Personel Dikerahkan</p></a>
                </div>
                <div class="news-item">
                    <img src="Media/berita3.png" alt="News 3">
                    <a href="https://www.detik.com/sumbagsel/hukum-dan-kriminal/d-7324338/gedung-asrama-di-sma-3-kayu-agung-ludes-terbakar-diduga-korsleting-listrik"><p>Gedung Asrama di SMA 3 Kayu Agung Ludes Terbakar <br>Diduga Korsleting Listrik</p></a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="contact-info">
            <p><a href="tel:+62xxxxxxxx">+62 xxxxxxxx</a></p>
            <p><a href="https://instagram.com/ESRindonesia" target="_blank">@ESRindonesia</a></p>
            <p><a href="mailto:ESRindonesia@gmail.com">ESRindonesia@gmail.com</a></p>
        </div>
        <div class="footer-logo">
            <img src="Media/logo2.png" alt="Emergency Fire Response Footer Logo">
        </div>
    </footer>
</body>
</html>
