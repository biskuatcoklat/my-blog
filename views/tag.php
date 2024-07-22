<?php
require_once(__DIR__ . '/../database/koneksi.php');
require_once(__DIR__ . '/../controller/function.php');

$tag = query("SELECT * from tags");
?>
<div class="box">
    <h3 class="title">popular tags</h3>
    <?php foreach ($tag as $tags) : ?>
        <div class="tags">
            <a href="https://www.google.com"><?= $tags['name']; ?></a>
        </div>
    <?php endforeach ?>
</div>