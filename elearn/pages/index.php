<?php
    if (isset($_GET['page']) && $_GET['page'] == 'courses') {
        require_once 'pages/courses.php';
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'course_details') {
        require_once 'pages/course_details.php';
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'sub') {
        require_once 'pages/sub.php';
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'userdash') {
        require_once 'pages/userdash.php';
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'settings') {
        require_once 'pages/settings.php';
    }
    elseif (isset($_GET['page']) && $_GET['page'] == 'wvideo') {
        require_once 'pages/wvideo.php';
    }
?>