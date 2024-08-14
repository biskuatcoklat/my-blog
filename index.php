<?php
require_once "../cms/database/koneksi.php";
require_once "../cms/controller/function.php";

$articles = [];

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $articles = searchArticles($query);
} else {
    $articles = query("SELECT articles.id, articles.title, articles.slug, articles.content, articles.foto, articles.created_at, categories.name AS category_name, users.username AS author
                        FROM articles
                        JOIN categories ON articles.category_id = categories.id
                        JOIN users ON articles.user_id = users.id");
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
            <?php foreach ($articles as $row) : ?>
                <div class="post">
                    <a href="#"><img src="/cms/controller/img/<?php echo $row["foto"]; ?>" alt="" class="image"></a>
                    <div class="date">
                        <i class="far fa-clock"></i>
                        <span>10 Nov, 2021</span>
                    </div>
                    <h3 class="title"><?= $row['title']; ?></h3>
                    <p class="text">
                        <?= strlen($row["content"]) > 100 ? substr($row["content"], 0, 100) . '...' : $row["content"]; ?>
                        <a href="../cms/views/detailcontent.php?id=<?= $row["id"]; ?>" style="color: blue;"><u>Berikut penjelasan</u></a>
                    </p>
                    <div class="links">
                        <?php
                        $date = new DateTime($row['created_at']);
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