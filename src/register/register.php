<?php
    if($_POST) {

        require_once('../../includes/conn.php');
        if (!isset($_SESSION)) {
            session_start();
        }

        $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;        ;
        $surname = isset($_POST['surname']) ? mysqli_real_escape_string($conn, $_POST['surname']) : null;
        $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : null;
        $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : null;

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

        if (!empty($password)) {
            $valid_password = true;
        } else {
            $valid_password = false;
            $errors['password'] = 'invalid password';
        }

        $insertUser = false;

        if (empty($errors)) {
            $insertUser = true;

            //Cifrar contraseña

            $secure_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

            $insert = "INSERT INTO users (name, surname, email, password, date) VALUES ('$name', '$surname', '$email', '$secure_password', current_date())";
            $query = mysqli_query($conn, $insert);

            if ($query) {
                $_SESSION['filled'] = 'register completed';
            } else {
                $_SESSION['errors']['general'] = 'registration failure';
            }

        } else {
            $_SESSION['errors'] = $errors;
            header('location:index.php');
        }

    }

    header('location:../../index.php');
    
?>