<?php
    if (isset($_GET['page']) && $_GET['page'] == 'files'){
        require_once "files.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_file') {
        require_once "add_file.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_file') {
        require_once "edit_file.php";
    }   
?>