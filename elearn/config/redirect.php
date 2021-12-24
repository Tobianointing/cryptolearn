<?php
// session_start();

if ($_SESSION['user_id'] == "" || $_SESSION['user_type'] != 'user') {

    $_SESSION['redirect_page'] = $_SERVER['REQUEST_URI'];
    
    header("Location: ./auth/login.php");
    // exit;
}
