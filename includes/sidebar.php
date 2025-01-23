<aside id="sidebar">
    <div id="search" class="block_aside">
        <h3>Search</h3>

        <form action="../src/search/search.php" method="POST">
            <input type="search" name="search" id="search">

            <input type="submit" value="Search">
        </form>
    </div>


    <?php
        if (isset($_SESSION['user'])) {
            echo "<div id='user-log' class='block_aside'>
            <h3>Wellcome, ".$_SESSION['user']['name'].' '.$_SESSION['user']['surname'].'!</h3>'.
            "<a href='/src/posts/newPost.php' class='button green-button'>New Post</a>".
            "<a href='/src/category/newCategory.php' class='button'>New Category</a>".
            "<a href='/src/profile/profile.php' class='button orange-button'>Profile</a>".
            "<a href='/src/logout/logout.php' class='button red-button'>Logout</a>".
            '</div>';
        }

        //var_dump($_SESSION['user']);
    ?>

    <!--Show errors-->

    <div id="login" class="block_aside <?php echo isset($_SESSION['user']) ? 'hidden' : '' ?>">
        <h3>Login</h3>

        <?php  
            if (isset($_SESSION['error_login'])) {
                echo "<div class='alert alert-error'>".$_SESSION['error_login'].'</div>';
            }
        ?>

        <form action="/src/login/login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
                    
            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Login">
        </form>
    </div>

    <?php  
        if (isset($_SESSION['error_login'])) {
            $_SESSION['error_login'] = null;
        }
    ?>

    <div id="register" class="block_aside <?php echo isset($_SESSION['user']) ? 'hidden' : '' ?>">
        <h3>Register</h3>

        <!--Show errors-->
        <?php
            if (isset($_SESSION['filled'])) {
                echo "<div class='alert alert-success'>".$_SESSION['filled'].'</div>';
            } else if(isset($_SESSION['errors']['general'])) {
                echo "<div class='alert alert-error'>".$_SESSION['errors']['general'].'</div>';
            }
        ?>



        <form action="/src/register/register.php" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
            <?php echo isset($_SESSION['errors']['name']) ? showErrors($_SESSION['errors'], 'name') : '' ?>

            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname">
            <?php echo isset($_SESSION['errors']['surname']) ? showErrors($_SESSION['errors'], 'surname') : '' ?>
                
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <?php echo isset($_SESSION['errors']['email']) ? showErrors($_SESSION['errors'], 'email') : '' ?>
                    
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <?php echo isset($_SESSION['errors']['password']) ? showErrors($_SESSION['errors'], 'password') : '' ?>

            <input type="submit" value="Register">
        </form>
        <?php 
            if(isset($_SESSION['errors'])) {
                $_SESSION['errors'] = null;
            } 
            
            if (isset($_SESSION['filled'])) {
                $_SESSION['filled'] = null;
            }
        ?>
    </div>
</aside>