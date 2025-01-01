<header class="header">
    <a href="/../cms/" class="logo"><span>My</span>Blog</a>
    <?php
    session_start();
    ?>
    <nav class="navbar">
        <a href="#banner">banner</a>
        <a href="#posts">my posts</a>
        <a href="#contact">contact me</a>
        <!-- <a href="/../cms/views/login.php">Login</a> -->
        <?php if (isset($_SESSION["login"])): ?>
            <a href="/../cms/views/logout.php" onclick="return confirm('Do you want to Logout?');">Logout</a>
        <?php else: ?>
            <a href="/../cms/views/login.php">Login</a>
        <?php endif; ?>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
    </div>

    <form action="" method="get" class="search-form">
        <input type="search" name="query" autocomplete="off" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form><br>

</header>