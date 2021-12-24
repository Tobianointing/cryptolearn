<?php
    if (isset($_GET['page']) && $_GET['page'] == 'videos'){
        require_once "videos.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'add_video') {
        require_once "add_video.php";
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'edit_video') {
        require_once "edit_video.php";
    }   
?>