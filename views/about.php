<?php
require_once(__DIR__ . '/../database/koneksi.php');
require_once(__DIR__ . '/../controller/function.php');

$admin = query("SELECT admin.*, users.username as nama FROM admin  INNER JOIN users ON admin.user_id = users.id");
?>
<div class="box">
    <h3 class="title">about me</h3>
    <div class="about">
        <?php foreach ($admin as $data) : ?>
            <img src="/cms/controller/img/<?php echo $data["image"]; ?>" alt="">
            <h3><?= $data['nama'] ?></h3>
            <p><?= $data['kata_kata_bijaksana'] ?></p>
            <div class="follow">
                <a href="<?= $data['link_fb'] ?>" class="fab fa-facebook-f"></a>
                <a href="<?= $data['link_twitter'] ?>" class="fab fa-twitter"></a>
                <a href="<?= $data['link_ig'] ?>" class="fab fa-instagram"></a>
                <a href="<?= $data['link_linkedin'] ?>" class="fab fa-linkedin"></a>
            </div>
        <?php endforeach ?>
    </div>
</div>