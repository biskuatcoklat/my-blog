<?php
require_once "../cms/database/koneksi.php";
require_once "../cms/controller/function.php";

$articles = [];

// Konfigurasi pagination
$articles_per_page = 5; // Jumlah artikel per halaman
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
$offset = ($current_page - 1) * $articles_per_page;

// Jika ada pencarian
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $articles = searchArticles($query);
} else {
    // Ambil total artikel untuk menghitung jumlah halaman
    $total_articles = query("SELECT COUNT(*) AS total FROM articles")[0]['total'];
    $total_pages = ceil($total_articles / $articles_per_page);

    // Query dengan limit dan offset
    $articles = query("SELECT articles.id, articles.title, articles.slug, articles.content, articles.foto, articles.created_at, categories.name AS category_name, users.username AS author
                        FROM articles
                        JOIN categories ON articles.category_id = categories.id
                        JOIN users ON articles.user_id = users.id
                        ORDER BY articles.created_at DESC
                        LIMIT $articles_per_page OFFSET $offset");
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
            <?php if (empty($articles)): ?>
                <p>Tidak ada artikel yang ditemukan.</p>
            <?php else: ?>
                <?php foreach ($articles as $row) : ?>
                    <div class="post">
                        <a href="#"><img src="/cms/controller/img/<?php echo $row["foto"]; ?>" alt="" class="image"></a>
                        <div class="date">
                            <i class="far fa-clock"></i>
                            <span><?= $row['category_name'] ?></span>
                        </div>
                        <h3 class="title"><?= $row['title']; ?></h3>
                        <p class="text">
                            <?= strlen($row["content"]) > 100 ? substr($row["content"], 0, 100) . '...' : $row["content"]; ?>
                            <a href="../cms/views/detailcontent.php?slug=<?= $row['slug']; ?>" style="color: blue;"><u>Berikut penjelasan</u></a>
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
            <?php endif; ?>
        </div>

        <div class="sidebar">
            <?php include "../cms/views/about.php" ?>
            <?php include "../cms/views/categories.php" ?>
            <?php include "../cms/views/tag.php" ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">

            <?php if ($current_page > 1): ?>
                <a class="btn btn-light" tabindex="-1" aria-disabled="true" href="?page=<?= $current_page - 1; ?>" class="prev">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i; ?>" class="<?= $i === $current_page ? 'active' : ''; ?> btn btn-light">
                    <?= $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="?page=<?= $current_page + 1; ?>" class="next btn btn-light">Next</a>
            <?php endif; ?>
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