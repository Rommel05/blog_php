<?php 
    require('../../includes/conn.php');
    require_once('../../helpers/helpers.php'); 
?>
<?php
    $postActive = getPostById($conn,$_GET['id']);

    //var_dump($postActive);
    

    if (!isset($postActive['id_post'])) {
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
            <h1><?= $postActive['post_title'] ?></h1>
            <a href="../category/category.php?id=<?=$postActive['id_category']?>">
                <h2><?= $postActive['category_name'] ?></h2>
            </a>
            <h4><?= $postActive['date']?> | <?= $postActive['user_name']?></h4>
            <p>
                <?= $postActive['post_content'] ?>
            </p>

            <?php
                if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $postActive['user_id']) {
                    echo "<a href='updatePost.php?id=".$postActive['id_post']."' class='button green-button'>Update Post</a>".
                    "<a href='removePost.php?id=".$postActive['id_post']."' class='button'>Remove Post</a>";

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