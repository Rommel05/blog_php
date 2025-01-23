<?php
    function showErrors($errors,$field) {
        if (!empty($errors[$field])) {
            return "<div class='alert alert-error'>".$errors[$field].'</div>';
        } else {
            return '';
        }
    }

    /*function deleteErrors() {
        $_SESSION['errors'] = null;
        unset($_SESSION['errors']);
    }*/

    function getCategories($conn) {
        $sql = 'SELECT * FROM category ORDER BY name ASC ';
        $categories =  mysqli_query($conn, $sql);
        $result = [];
        if ($categories && mysqli_num_rows($categories) >= 1) {
            $result = $categories;
        }

        return $result;
    }

    function getCategoryById($conn, $id) {
        $sql = "SELECT * FROM category WHERE id = $id";
        $categories =  mysqli_query($conn, $sql);
        $result = [];
        if ($categories && mysqli_num_rows($categories) >= 1) {
            $result = mysqli_fetch_assoc($categories);
        }

        return $result;
    }

    function getPostById($conn, $id) {
        $sql = "SELECT p.id AS id_post, p.title as post_title, p.content as post_content, p.date, p.user_id, c.name as category_name, c.id as id_category, pc.*, u.id as user_id, concat(u.name,' ', u.surname) as user_name 
            FROM posts p
            INNER JOIN post_category pc ON pc.post_id = p.id
            INNER JOIN category c ON c.id = pc.category_id 
            INNER JOIN users u ON u.id = p.user_id
            WHERE p.id = $id";

        $post =  mysqli_query($conn, $sql);
        $result = [];
        if ($post && mysqli_num_rows($post) >= 1) {
            $result = mysqli_fetch_assoc($post);
        }

        return $result;
    }

    function getPosts($conn, $limit = null, $category = null, $search = null) {
        $sql = 'SELECT p.id AS id_post, p.title as post_title, p.content as post_content, p.date, p.user_id, c.name as category_name, c.id as id_category, pc.* 
            FROM posts p
            INNER JOIN post_category pc ON pc.post_id = p.id
            INNER JOIN category c ON c.id = pc.category_id ';

            if (!empty($category)) {
                $sql .= "WHERE c.id = $category ";
            }

            if (!empty($search)) {
                $sql .= "WHERE p.title LIKE '%$search%'";
            } 

        $sql .= 'GROUP BY p.id ORDER BY DATE DESC ';

        if (isset($limit)) {
            $sql .= 'LIMIT 4';
        }  
        
        /*echo $sql;
        die();*/
        
        $categories =  mysqli_query($conn, $sql);
        $result = [];
        if ($categories && mysqli_num_rows($categories) >= 1) {
            $result = $categories;
        }

        return $result;
    }
?>