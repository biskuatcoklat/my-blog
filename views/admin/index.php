<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: ../login.php");
    exit;
}
require_once(__DIR__ . '/../../database/koneksi.php');
require_once(__DIR__ . '/../../controller/function.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Halo Admin</h1>
        <br>
        <a href="daftararticle.php"><button for="tambah" name="tambah" class="btn btn-primary">Daftar Article</button></a>
        <a href="category.php"><button for="tambah" name="tambah" class="btn btn-primary">Daftar Category</button></a>
        <a href="tag.php"><button for="tambah" name="tambah" class="btn btn-primary">Daftar Tag</button></a>
        <a href="/../cms/views/logout.php" onclick="return confirm('Do you want to Logout?');"><button for="tambah" name="logout" class="btn btn-danger">Logout</button></a>
        <br><br>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>