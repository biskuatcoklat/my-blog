<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["usertype"] !== 'admin') {
    header("location: ../login.php");
    exit;
}

require_once(__DIR__ . '/../../database/koneksi.php');
require_once(__DIR__ . '/../../controller/function.php');
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("location: login.php");
//     exit;
// }

// cek apakah tombol submit sudah ditekan atau belum
// Mengambil data users untuk Author select option
$users = query("SELECT id, username FROM users");

// Mengambil data categories untuk Category select option
$categories = query("SELECT id, name FROM categories");

if (isset($_POST["submit"])) {
    //cek apakah data berhasil ditambahkan atau tidak
    if (tambaharticle($_POST) > 0) {
        echo "<script>alert('data berhasil ditambahkan');
        document.location.href = '../admin/daftararticle.php';</script>";
    } else {
        echo "<script>alert('data gagal ditambahkan');
        document.location.href = '../admin/tambaharticle.php';</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Add Data</title>
</head>

<body>
    <div class="container">
        <br>
        <h1>Add Data Article</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Author</label>
                <select class="form-select" name="user_id" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category</label>
                <select class="form-select" name="category_id" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto</label><br>
                <input type="file" name="foto" id="foto" required autocomplete="off"></input>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>