<?php
// session_start(); // Memulai session
if (
    session_status() === PHP_SESSION_NONE
) {
    session_start();
}
require_once(__DIR__ . '/../database/koneksi.php');
require_once(__DIR__ . '/../controller/function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pengecekan apakah user sudah login
    if (!isset($_SESSION['login'])) {
        echo "<script>
            alert('You need to log in to send a message!');
            window.location.href = '/../cms/views/login.php';
        </script>";
        exit;
    }

    // Jika sudah login, proses pengiriman pesan
    if (isset($_POST['submit'])) {
        if (tambahpesan($_POST) > 0) {
            echo "<script>alert('Message sent successfully!')</script>";
        } else {
            echo "<script>alert('Failed to send message')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Sesuaikan dengan file CSS Anda -->
</head>

<body>

    <section class="contact" id="contact">

        <form action="" method="POST">
            <h3>Contact Me</h3>
            <div class="inputBox">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="inputBox">
                <input type="number" name="number" placeholder="Number" required>
                <input type="text" name="subject" placeholder="Subject" required>
            </div>
            <textarea name="message" placeholder="Message" cols="30" rows="10" required></textarea>
            <input type="submit" name="submit" value="Send Message" class="btn">
        </form>

    </section>

</body>

</html>