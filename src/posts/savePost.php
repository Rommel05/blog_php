<?php
    if ($_POST) {
        require_once('../../includes/conn.php');

        if (!isset($_SESSION)) {
            session_start();
        }

        $title = isset($_POST['title']) ? mysqli_real_escape_string($conn,$_POST['title']) : null;
        $content = isset($_POST['content']) ? mysqli_real_escape_string($conn,$_POST['content']) : null;
        $category = isset($_POST['category']) ? mysqli_real_escape_string($conn,$_POST['category']) : null;
        $id = $_SESSION['user']['id'];
        
        $errors = [];

        if (!empty($title)) {
            $valid_title = true;
        } else {
            $valid_title = false;
            $errors['title'] = 'Title cannot be empty';
        }

        if (!empty($content)) {
            $valid_content = true;
        } else {
            $valid_content = false;
            $errors['content'] = 'Content cannot be empty';
        }

        if (!empty($category)) {
            $valid_category = true;
        } else {
            $valid_category = false;
            $errors['category'] = 'Category cannot be empty';
        }

        if (empty($errors)) {
            if (isset($_GET['edit'])) {
                $update = "UPDATE posts SET title = '$title', content = '$content' WHERE user_id = $id";
                $query = mysqli_query($conn,$update);

                if ($query) {
                    $update2 = "UPDATE post_category SET category_id = $category WHERE post_id =". $_GET['edit'];
                    $query = mysqli_query($conn,$update2);
                }
                header('location:../../index.php');
            } else {
                $sql = "INSERT INTO posts (title, content, date, user_id) VALUES ('$title', '$content', CURRENT_DATE(), $id)";
                $query = mysqli_query($conn,$sql);

                if ($query) {
                    $post_id = mysqli_insert_id($conn);
                    $sql2 = "INSERT INTO post_category VALUES ($post_id, $category)";
                    $query2 = mysqli_query($conn, $sql2);

                    if (!$query2) {
                        $_SESSION['error_insert2'] = mysqli_error($conn);    
                    }
                } else {
                    $_SESSION['error_insert'] = mysqli_error($conn);    
                }
                header('location:../../index.php');
            }
            
        } else {
            $_SESSION['errors_post'] = $errors;
            if (isset($_GET['edit'])) {
                header('location:updatePost.php?id='.$_GET['editar']);
            } else {
                header('location:newPost.php');
            }
            
            
        }

        
    }
 
?>