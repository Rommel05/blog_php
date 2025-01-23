<header id="header">
    <div id="logo">

        <a href="../../index.php">BLOG</a>

    </div>

    <!--Menu-->
    <nav id="nav">
        <ul>
            <li>
                <a href="../../index.php">Home</a>
            </li>
            
            <?php 
                $categories = getCategories($conn);

                if (!empty($categories)) {
                    while ($category = mysqli_fetch_assoc($categories)) {
                        echo '<li><a href="/src/category/category.php?id=' . $category['id'] . '">' . $category['name'] . '</a></li>';
                    }
                }
            ?>

            <li>
                <a href="../../index.php">About me</a>
            </li>
            <li>
                <a href="../../index.php">Contact</a>
            </li>
        </ul>
    </nav>

    <div class="clearfix"></div>

</header>