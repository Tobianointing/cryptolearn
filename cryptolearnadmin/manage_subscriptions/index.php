<?php
    if (isset($_GET['page']) && $_GET['page'] == 'subscriptions'){
        require_once "subscriptions.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_subscription') {
        require_once "add_subscription.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_subscription') {
        require_once "edit_subscription.php";
    }   
?>