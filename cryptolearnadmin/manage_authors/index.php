<?php
    if (isset($_GET['page']) && $_GET['page'] == 'authors'){
        require_once "authors.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_author') {
        require_once "add_author.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_author') {
        require_once "edit_author.php";
    }   
?>