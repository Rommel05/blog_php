<?php
    require_once('../../includes/conn.php');

    if (isset($_SESSION['user']) && isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $user_id = $_SESSION['user']['id'];
        $sql = "DELETE FROM posts WHERE id = $post_id AND user_id = $user_id";
        mysqli_query($conn, $sql);
    };

    header('location:../../index.php');
?>