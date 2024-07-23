<?php
require_once(__DIR__ . '/../database/koneksi.php');
require_once(__DIR__ . '/../controller/function.php');

if (isset($_POST['submit'])) {
    if (tambahpesan($_POST) > 0) {
        echo "<script>alert('Success')</script>";
    } else {
        echo "<script>alert('Failed')</script>";
    }
}
?>
<section class="contact" id="contact">

    <form action="" method="POST">
        <h3>contact me</h3>
        <div class="inputBox">
            <input type="text" name="name" placeholder="name">
            <input type="email" name="email" placeholder="email">
        </div>
        <div class="inputBox">
            <input type="number" name="number" placeholder="number">
            <input type="text" name="subject" placeholder="subject">
        </div>
        <textarea name="message" placeholder="message" id="" cols="30" rows="10"></textarea>
        <input type="submit" name="submit" value="send message" class="btn">
    </form>

</section>