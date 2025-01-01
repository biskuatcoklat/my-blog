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
$admin = query("SELECT * FROM admin WHERE id = $id")[0];

// Mengambil data users untuk Author select option
$users = query("SELECT id, username FROM users");


if (isset($_POST["submit"])) {
    // Cek apakah data berhasil diperbarui atau tidak
    if (editprofile($_POST) > 0) {
        echo "<script>alert('Data berhasil diperbarui');
        document.location.href = '../admin/profile.php';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui');
        document.location.href = 'editprofile.php?id=$id';</script>";
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
    <title>Edit Profile</title>
</head>

<body>
    <div class="container">
        <br>
        <h1>Edit Data Profile</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $admin['id']; ?>">
            <div class="mb-3">
                <label for="user_id" class="form-label">Nama User</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id']; ?>" <?= $user['id'] == $admin['user_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($user['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Kata Kata</label>
                <input type="text" name="kata_kata_bijaksana" class="form-control" id="exampleFormControlInput1" value="<?= $admin['kata_kata_bijaksana']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Hobi</label>
                <input type="text" class="form-control" name="hobi" id="exampleFormControlInput1" value="<?= $admin['hobi']; ?>" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto</label><br>
                <input type="file" name="image" id="image" autocomplete="off"></input>
                <input type="hidden" name="foto_lama" value="<?= $admin['image']; ?>">
                <br><br>
                <img src="/cms/controller/img/<?= $admin['image']; ?>" width="100">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Link IG</label>
                <input type="text" class="form-control" name="link_ig" id="exampleFormControlInput1" value="<?= $admin['link_ig']; ?>" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Link Fb</label>
                <input type="text" class="form-control" name="link_fb" id="exampleFormControlInput1" value="<?= $admin['link_fb']; ?>" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Link Linkedin</label>
                <input type="text" class="form-control" name="link_linkedin" id="exampleFormControlInput1" value="<?= $admin['link_linkedin']; ?>" />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Link Twitter</label>
                <input type="text" class="form-control" name="link_twitter" id="exampleFormControlInput1" value="<?= $admin['link_twitter']; ?>" />
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>