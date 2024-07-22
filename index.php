<?php
require_once "../cms/database/koneksi.php";
require_once "../cms/controller/function.php";

$article = query("SELECT articles.id, articles.title, articles.slug, articles.content, articles.foto ,articles.created_at ,categories.name AS category_name, users.username AS author
                FROM articles
                JOIN categories ON articles.category_id = categories.id
                JOIN users ON articles.user_id = users.id");
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
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- header section starts  -->

    <?php include "../cms/views/header.php" ?>

    <!-- header section ends -->

    <!-- banner section starts  -->

    <?php include "../cms/views/banner.php" ?>

    <!-- banner section ends -->

    <!-- posts section starts  -->

    <section class="container" id="posts">

        <div class="posts-container">
            <?php foreach ($article as $row) : ?>
                <div class="post">
                    <a href="https://www.google.com/url?sa=i&url=https%3A%2F%2Fsasanadigital.com%2Fmemilih-konsultan-bisnis-online%2F&psig=AOvVaw1SkunL6XanTKHl418B73rW&ust=1637136756412000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCPiXmeu3nPQCFQAAAAAdAAAAABAD"><img src="/cms/controller/img/<?php echo $row["foto"]; ?>" alt="" class="image"></a>
                    <div class="date">
                        <i class="far fa-clock"></i>
                        <span>10 Nov, 2021</span>
                    </div>
                    <h3 class="title"><?= $row['title']; ?></h3>

                    <p class="text"><?= $row['content']; ?> <a href="judul 1.html" style="color: blue;"><u>Berikut penjelasan</u></a> </p>
                    <div class="links">
                        <?php
                        $date = new DateTime($row['created_at']);

                        // Mengubah format tanggal dan waktu
                        $formatted_date = $date->format('d-m-Y H:i');
                        ?>
                        <a href="#" class="user">
                            <i class="far fa-user"></i>
                            <span>by <?= $row['author']; ?></span>
                        </a>
                        <a href="#" class="icon">
                            <i class="far fa-calender"></i>
                            <span><?= $formatted_date; ?></span>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="sidebar">

            <?php include "../cms/views/about.php" ?>

            <?php include "../cms/views/categories.php" ?>

            <?php include "../cms/views/tag.php" ?>

        </div>

    </section>

    <!-- posts section ends -->

    <!-- contact section starts  -->

    <?php include "../cms/views/contact.php" ?>

    <!-- contact section ends -->

    <!-- footer section starts  -->

    <?php include "../cms/views/footer.php" ?>

    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="script.js"></script>

</body>

</html>