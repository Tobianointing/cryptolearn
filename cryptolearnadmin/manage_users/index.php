<?php
    if (isset($_GET['page']) && $_GET['page'] == 'users'){
        require_once "users.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_user') {
        require_once "add_user.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_user') {
        require_once "edit_user.php";
    }   
?>