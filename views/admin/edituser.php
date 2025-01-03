<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["usertype"] !== 'admin') {
    header("location: ../login.php");
    exit;
}

require_once(__DIR__ . '/../../database/koneksi.php');
require_once(__DIR__ . '/../../controller/function.php');

// Ambil id artikel dari query string
$id = $_GET['id'];

// Ambil data artikel berdasarkan id
$user = query("SELECT * FROM users WHERE id = $id")[0];


if (isset($_POST["submit"])) {
    // Cek apakah data berhasil diperbarui atau tidak
    if (edituser($_POST) > 0) {
        echo "<script>alert('Data berhasil diperbarui');
        document.location.href = '../admin/user.php';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui');
        document.location.href = 'edituser.php?id=$id';</script>";
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
    <title>Edit User</title>
</head>

<body>
    <div class="container">
        <br>
        <h1>Edit Data User</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $user['id']; ?>">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" name="username" class="form-control" id="exampleFormControlInput1" value="<?= $user['username']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Slug</label>
                <input type="text" name="email" class="form-control" id="exampleFormControlInput1" value="<?= $user['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="usertype" id="exampleFormControlTextarea1" rows="3"><?= $user['usertype']; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>