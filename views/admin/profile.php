<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["usertype"] !== 'admin') {
    header("location: ../login.php");
    exit;
}

require_once(__DIR__ . '/../../database/koneksi.php');
require_once(__DIR__ . '/../../controller/function.php');


if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    delete_category($id);
}

$admin = query("SELECT admin.*, users.username as nama FROM admin  INNER JOIN users ON admin.user_id = users.id");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <br>
        <h1>Profile</h1>
        <br>
        <!-- <a href="tambahcategory.php"><button for="tambah" name="tambah" class="btn btn-primary">Add Data</button></a> -->



        <table class="table">
            <thead>

                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kata Kata</th>
                    <th>Hobi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1; ?>
                <?php foreach ($admin as $row) : ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["kata_kata_bijaksana"]; ?></td>
                        <td><?= $row["hobi"]; ?></td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="editprofile.php?id=<?= $row["id"]; ?>" class="btn btn-warning btn-sm text-white">Edit</a>

                            </div>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php"><button for="tambah" name="tambah" class="btn btn-primary">Back</button></a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>