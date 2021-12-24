<?php
session_start(); 

unset($_SESSION['user_id']);
unset($_SESSION['video_access']);

session_destroy();

header("Location: ./login.php");