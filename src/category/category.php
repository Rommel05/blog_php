<?php 
    require('../../includes/conn.php');
    require_once('../../helpers/helpers.php'); 
?>
<?php
    $categoryActive = getCategoryById($conn,$_GET['id']);

    if (!isset($categoryActive['id'])) {
        header('location:../../index.php');
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto_PHP</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <!--HEADER-->
    <?php
        require_once('../../includes/header.php');
    ?>

    
    <div id="container">

        <!--SIDEBAR-->
        <?php
            require_once('../../includes/sidebar.php')
        ?>

        <!--Main_Content-->
        <main id="main">
            <h1>Posts de <?= $categoryActive['name'] ?></h1>

            <?php
                $posts = getPosts($conn, null, $_GET['id']);

                if (!empty($posts) && mysqli_num_rows($posts) >= 1) {
                    while($post = mysqli_fetch_assoc($posts)) {
                        //var_dump($post);
                        echo "<article class='post'><a href='../posts/post.php?id=".$post['id_post']."'>".
                        "<h2>".$post['post_title']."</h2>".
                        "<span class='date'>".$post['category_name'].' | '.$post['date'].'</span>'.
                        "<p>".substr($post['post_content'],0,180)."...</p>".
                        "</a></article>";
                    }
                } else {
                    echo "<div class='alert'>There are no posts in this category</div>"; 
                }  
            ?>
        </main>

       

        <div class="clearfix"></div>

    </div>

    <!--Footer-->
    <?php
        require_once('../../includes/footer.php')
    ?>
    
</body>
</html>  