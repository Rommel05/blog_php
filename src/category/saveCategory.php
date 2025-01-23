<?php
    if ($_POST) {
        require_once('../../includes/conn.php');

        if (!isset($_SESSION)) {
            session_start();
        }

        $name = isset($_POST['name']) ? mysqli_real_escape_string($conn,$_POST['name']) : null;
        
        $errors = [];

        if (!empty($name) && !preg_match('/\d/', $name)) {
            $valid_name = true;
        } else {
            $valid_name = false;
            $errors['name'] = 'Invalid name';
        }

        if (empty($errors)) {
            $sql = "INSERT INTO category (name) VALUES ('$name')";
            $query = mysqli_query($conn,$sql);
        }

        header('location:../../index.php');
    }
 
?>