<?php
    if (isset($_GET['page']) && $_GET['page'] == 'logi') {
        require_once 'auth/login.php';
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'register') {
        require_once 'auth/register.php';
    }
?>