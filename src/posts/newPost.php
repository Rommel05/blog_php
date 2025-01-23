<?php
    //require_once('./includes/redirect.php');
    //require_once('./includes/conn.php');
    //require_once('./helpers/helpers.php');
    require_once("../../includes/redirect.php");
    require_once("../../includes/conn.php");
    require_once("../../helpers/helpers.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New post</title>
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

        <main id="main">
            <h1>New post</h1>
            <form action="savePost.php" method="post">
                <label for="title">Title</label>
                <input type="text" name="title" id="title">
                <?php echo isset($_SESSION['errors_post']['title']) ? showErrors($_SESSION['errors_post'], 'title') : '' ?>

                <label for="content">Content</label>
                <textarea name="content" id="content"></textarea>
                <?php echo isset($_SESSION['errors_post']['content']) ? showErrors($_SESSION['errors_post'], 'content') : '' ?>

                <label for="category">Category</label>
                <select name="category" id="category">
                    <?php
                        $categories = getCategories($conn);

                        if (!empty($categories)) {
                            while ($category = mysqli_fetch_assoc($categories)) {
                                echo "<option value='".$category['id']."'>".$category['name'].'</option>';
                            }
                        }
                    ?>
                    
                </select>
                <?php echo isset($_SESSION['errors_post']['category']) ? showErrors($_SESSION['errors_post'], 'category') : '' ?>

                <input type="submit" value="Save">
            </form>
            <?php
                if(isset($_SESSION['errors_post'])) {
                    unset($_SESSION['errors_post']);
                }
            ?>
        </main>
        
        <div class="clearfix"></div>

    </div>

    <?php
        require_once('../../includes/footer.php')
    ?>

</body>
</html>