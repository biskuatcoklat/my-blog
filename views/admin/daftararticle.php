<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: ../login.php");
    exit;
}
require_once(__DIR__ . '/../../database/koneksi.php');
require_once(__DIR__ . '/../../controller/function.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    delete_articles($id);
}

$article = query("SELECT articles.id, articles.title, articles.slug, articles.content, articles.created_at, articles.foto ,categories.name AS category_name, users.username AS author
                FROM articles
                JOIN categories ON articles.category_id = categories.id
                JOIN users ON articles.user_id = users.id");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Daftar Article</h1>
        <br>
        <a href="tambaharticle.php"><button for="tambah" name="tambah" class="btn btn-primary">Add Data</button></a>
        <br><br>


        <table class="table">
            <thead>

                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>content</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1; ?>
                <?php foreach ($article as $row) : ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?= $row["title"]; ?></td>
                        <td><?= $row["slug"]; ?></td>
                        <td><?= $row["content"]; ?></td>
                        <td><?= $row["category_name"]; ?></td>
                        <td><?= $row["author"]; ?></td>
                        <td><img src="/cms/controller/img/<?php echo $row["foto"]; ?>" width="100"></td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="editarticle.php?id=<?= $row["id"]; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="" method="post" style="margin: 0;">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this article?');">Delete</button>
                                </form>
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