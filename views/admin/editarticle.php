<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: ../login.php");
    exit;
}
require_once(__DIR__ . '/../../database/koneksi.php');
require_once(__DIR__ . '/../../controller/function.php');

// Ambil id artikel dari query string
$id = $_GET['id'];

// Ambil data artikel berdasarkan id
$article = query("SELECT * FROM articles WHERE id = $id")[0];

// Mengambil data users untuk Author select option
$users = query("SELECT id, username FROM users");

// Mengambil data categories untuk Category select option
$categories = query("SELECT id, name FROM categories");

if (isset($_POST["submit"])) {
    // Cek apakah data berhasil diperbarui atau tidak
    if (editarticle($_POST) > 0) {
        echo "<script>alert('Data berhasil diperbarui');
        document.location.href = '../admin/daftararticle.php';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui');
        document.location.href = 'editarticle.php?id=$id';</script>";
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
    <title>Edit Article</title>
</head>

<body>
    <div class="container">
        <h1>Edit Data Article</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $article['id']; ?>">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="<?= $article['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" id="exampleFormControlInput1" value="<?= $article['slug']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"><?= $article['content']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Author</label>
                <select class="form-select" name="user_id" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= $user['id']; ?>" <?= $user['id'] == $article['user_id'] ? 'selected' : ''; ?>><?= $user['username']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Category</label>
                <select class="form-select" name="category_id" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id']; ?>" <?= $category['id'] == $article['category_id'] ? 'selected' : ''; ?>><?= $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto</label><br>
                <input type="file" name="foto" id="foto" autocomplete="off"></input>
                <input type="hidden" name="foto_lama" value="<?= $article['foto']; ?>">
                <br><br>
                <img src="/cms/controller/img/<?= $article['foto']; ?>" width="100">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>