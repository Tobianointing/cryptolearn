<?php
    if (isset($_GET['page']) && $_GET['page'] == 'view_profile'){
        require_once "view_profile.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_profile') {
        require_once "edit_profile.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_admin') {
        require_once "add_admin.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'view_admins') {
        require_once "view_admins.php";
    }
?>