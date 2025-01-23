<?php
    require_once('../../includes/redirect.php');
    require_once('../../includes/conn.php');
    require_once('../../helpers/helpers.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New category</title>
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
            <h1>New category</h1>
            <form action="saveCategory.php" method="post">
                <label for="name">Category name</label>
                <input type="text" name="name" id="name">
                <input type="submit" value="Save">
            </form>
        </main>
        
        <div class="clearfix"></div>

    </div>

    <?php
        require_once('../../includes/footer.php')
    ?>

</body>
</html>