<?php
    if (isset($_GET['page']) && $_GET['page'] == 'login'){
        require_once "login.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'register') {
        require_once "register.php";
    }
?>