<?php
require_once(__DIR__ . '/../database/koneksi.php');
require_once(__DIR__ . '/../controller/function.php');

$category = query("SELECT * from categories");
?>
<div class="box">
    <h3 class="title">categories</h3>
    <?php foreach ($category as $row) : ?>
        <div class="category">
            <a href="#"> <?= $row['name']; ?> <span>1</span></a>
        </div>
    <?php endforeach ?>
</div>