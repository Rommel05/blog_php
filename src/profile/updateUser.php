<?php
    if($_POST) {

        require_once('../../includes/conn.php');
        if (!isset($_SESSION)) {
            session_start();
        }

        $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;        ;
        $surname = isset($_POST['surname']) ? mysqli_real_escape_string($conn, $_POST['surname']) : null;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : null;

        $errors = [];

        //Validation
        if (!empty($name) && !preg_match('/\d/', $name)) {
            $valid_name = true;
        } else {
            $valid_name = false;
            $errors['name'] = 'invalid name';
        }

        if (!empty($surname) && !preg_match('/\d/', $surname)) {
            $valid_surname = true;
        } else {
            $valid_surname = false;
            $errors['surname'] = 'invalid surname';
        }

        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid_email = true;
        } else {
            $valid_email = false;
            $errors['email'] = 'invalid email';
        }

        $updateUser = false;

        if (empty($errors)) {
            $user = $_SESSION['user'];
            $updateUser = true;
            $sql = "SELECT id, email FROM users WHERE email = '$email'";
            $isset_email = mysqli_query($conn, $sql);
            $isset_user = mysqli_fetch_assoc($isset_email);

            if ($isset_user['id'] == $user['id'] || empty($isset_user)) {

                $update = "UPDATE users SET name = '$name', surname = '$surname', email = '$email' WHERE id =". $user['id'];
                $query = mysqli_query($conn, $update);

                if ($query) {
                    $_SESSION['user']['name'] = $name;
                    $_SESSION['user']['surname'] = $surname;
                    $_SESSION['user']['email'] = $email;

                    $_SESSION['filled'] = 'update completed';
                } else {
                    $_SESSION['errors']['general'] = 'update failure';
                }
            } else {
                $_SESSION['errors']['general'] = 'existing user';
            }
        } else {
            $_SESSION['errors'] = $errors;
            header('location:profile.php');
        }
    }

    header('location:profile.php');
    
?>