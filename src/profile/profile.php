
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
    <title>My data</title>
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
            require_once('../../includes/sidebar.php');
        ?>

        <main id="main">
            <h1>My profile</h1>
            <?php
                if (isset($_SESSION['filled'])) {
                    echo "<div class='alert alert-success'>".$_SESSION['filled'].'</div>';
                } else if(isset($_SESSION['errors']['general'])) {
                    echo "<div class='alert alert-error'>".$_SESSION['errors']['general'].'</div>';
                }
            ?>
            <form action="updateUser.php" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" <?php echo isset($_SESSION['user']['name']) ? "value='".$_SESSION['user']['name']."'" : '' ?>>
            <?php echo isset($_SESSION['errors']['name']) ? showErrors($_SESSION['errors'], 'name') : '' ?>

            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname" <?php echo isset($_SESSION['user']['surname']) ? "value='".$_SESSION['user']['surname']."'" : '' ?>>
            <?php echo isset($_SESSION['errors']['surname']) ? showErrors($_SESSION['errors'], 'surname') : '' ?>
                
            <label for="email">Email</label>
            <input type="email" name="email" id="email" <?php echo isset($_SESSION['user']['email']) ? "value='".$_SESSION['user']['email']."'" : '' ?>>
            <?php echo isset($_SESSION['errors']['email']) ? showErrors($_SESSION['errors'], 'email') : '' ?>

            <input type="submit" value="Update">
        </form>
            <?php 
                if(isset($_SESSION['errors'])) {
                    $_SESSION['errors'] = null;
                } 
                
                if (isset($_SESSION['filled'])) {
                    $_SESSION['filled'] = null;
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