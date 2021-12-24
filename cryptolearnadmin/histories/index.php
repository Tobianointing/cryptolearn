<?php
    if (isset($_GET['page']) && $_GET['page'] == 'subscription_histories'){
        require_once "subscription_histories.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_user') {
        require_once "add_user.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_user') {
        require_once "edit_user.php";
    }   
?>