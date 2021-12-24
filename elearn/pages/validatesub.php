<?php
include '../config/constants.php';
// die($_GET['id']);
$course_id = $_GET['id'];
$level = $_GET['level'];

// die(strtolower($level));

if (strtolower($level) == strtolower('Advance')) {
    $level = 3;
} elseif (strtolower($level) == strtolower('Intermediate')) {
    $level = 2;
} elseif (strtolower($level) == strtolower('beginner')) {
    $level = 1;
   
}
// die(var_dump($level));
// die(var_dump($_GET));
$user_id = $_SESSION['user_id'];

$query2 = "SELECT * FROM courses_enrolled WHERE user_id=? AND course_id=?";
$stmt2 = $pdo->prepare($query2);
$stmt2->execute([$user_id, $course_id]);
$result2 = $stmt2->fetchAll();

$query1 = "SELECT * FROM sub_history WHERE user_id=?";
$stmt1 = $pdo->prepare($query1);
$stmt1->execute([$user_id]);
$results = $stmt1->fetchAll();



if ($stmt2->rowCount() > 0) {
    foreach ($results as $rs) {
        if ($rs->sub_id == $level && $rs->status == 1) {
            $_SESSION['open'] = "start course";
            $_SESSION['video_access'] = "true";

            header("Location: ../?module=pages&page=wvideo&course_id={$course_id}");
            exit();
        }
    }
    $_SESSION['sub_expired'] = '<div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
    Subscription has exipred click the link to subscribe <a class="ml-5 text-danger" href="?module=pages&page=sub">Subscribe</a>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>';
    header("Location: ../?module=pages&page=course_details&id={$course_id}");
    exit();
} else {
    foreach ($results as $rs) {
        if ($rs->sub_id == $level && $rs->status == 1) {
            $_SESSION['open'] = "start course";
            $_SESSION['video_access'] = "true";

            $query3 = "INSERT INTO courses_enrolled (user_id,course_id) VALUES (?,?)";
            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute([$user_id, $course_id]);
            // $results = $stmt3->fetchAll();

            header("Location: ../?module=pages&page=wvideo.php?course_id={$course_id}");
            exit();
        }
    }
    $_SESSION['not_subscribe'] = '<div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
    Not subscribe click the link to subscribe <a class="ml-5 text-danger" href="?module=pages&page=sub">Subscribe</a>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>';
    header("Location: ../?module=pages&page=course_details&id={$course_id}");
    exit();
}
