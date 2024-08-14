<?php
require_once(__DIR__ . '/../database/koneksi.php');
require_once(__DIR__ . '/../controller/function.php');

$articles = [];
// Ambil id artikel dari query string
$id = $_GET['id'];

// Ambil data artikel berdasarkan id
if ($id) {
    $article = query("SELECT articles.*, users.username AS author 
                      FROM articles 
                      JOIN users ON articles.user_id = users.id 
                      WHERE articles.id = $id")[0];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            /* Menengahkan secara horizontal */
            align-items: center;
            /* Menengahkan secara vertikal jika diperlukan */
            min-height: 100vh;
            /* Tinggi minimum */
        }

        .posts-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            width: 100%;
            /* Sesuaikan dengan lebar container */
            max-width: 1500px;
            /* Batas maksimal lebar */
        }

        .post {
            width: 100%;
            /* Membuat lebar post mengikuti lebar container */
            max-width: 1200px;
            /* Sesuaikan lebar post */
            padding: 20px;
            box-sizing: border-box;
            /* Pastikan padding tidak menambah lebar elemen */
            background-color: #fff;
            /* Optional: tambahkan background untuk lebih terlihat */
        }
    </style>
</head>

<body>
    <!-- header section starts  -->
    <?php include "../../cms/views/header.php" ?>
    <!-- header section ends -->

    <!-- banner section starts  -->
    <?php include "../../cms/views/banner.php" ?>
    <!-- banner section ends -->

    <!-- posts section starts  -->
    <section class="container" id="posts">
        <div class="posts-container">
            <div class="post">
                <input type="hidden" name="id" value="<?= $article['id']; ?>">
                <a href="#"><img src="/cms/controller/img/<?php echo $article["foto"]; ?>" alt="" class="image"></a>
                <div class="date">
                    <i class="far fa-clock"></i>
                    <span>10 Nov, 2021</span>
                </div>
                <h3 class="title"><?= $article['title']; ?></h3>
                <p class="text"><?= $article['content']; ?> </p>
                <div class="links">
                    <?php
                    $date = new DateTime($article['created_at']);
                    $formatted_date = $date->format('d-m-Y H:i');
                    ?>
                    <a href="#" class="user">
                        <i class="far fa-user"></i>
                        <span>by <?= $article['author']; ?></span>
                    </a>
                    <a href="#" class="icon">
                        <i class="far fa-calender"></i>
                        <span><?= $formatted_date; ?></span>
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- posts section ends -->

    <!-- contact section starts  -->
    <?php include "../../cms/views/contact.php" ?>
    <!-- contact section ends -->

    <!-- footer section starts  -->
    <?php include "../../cms/views/footer.php" ?>
    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="../script.js"></script>
</body>

</html>