<?php
    $server = 'localhost';
    $user = 'rommel';
    $password = 'sa';
    $db = 'blog2';

    $conn = mysqli_connect($server, $user, $password, $db);

    mysqli_query($conn, "SET NAMES 'utf8'");
    
    if (!isset($_SESSION)) {
        session_start();
    }

?>