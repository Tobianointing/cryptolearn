<?php
    if (isset($_GET['page']) && $_GET['page'] == 'courses'){
        require_once "courses.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_course') {
        require_once "add_course.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_course') {
        require_once "edit_course.php";
    }   
?>