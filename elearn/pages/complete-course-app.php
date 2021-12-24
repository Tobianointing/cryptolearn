<?php
include '../config/constants.php';

if (isset($_GET['course_id']) && !empty($_GET['course_id']) && !empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $course_id = $_GET['course_id'];

    $query = "UPDATE courses_enrolled SET completed=? WHERE course_id=? AND user_id=?";
    $stmt = $pdo->prepare($query);
    $status = $stmt->execute([1, $course_id, $user_id]);

    if ($status) {

        header("Location: ../?module=pages&page=userdash");
    }
}
