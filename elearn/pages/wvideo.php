<?php
$access = $_SESSION['video_access'];
// unset($_SESSION['video_access']);

if ($access != 'true') {
    header("Location: ./auth/login.php");
}

$course_id = $_GET['course_id'];

if (isset($_GET['v_id'])) {
    $v_id = $_GET['v_id'];
    $query = "SELECT * FROM videos WHERE course_id=? AND id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$course_id, $v_id]);
    $result = $stmt->fetch();

    // var_dump($result);
}

$query = "SELECT * FROM videos WHERE course_id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$course_id]);
$results = $stmt->fetchAll();

if (isset($_GET['v_id'])) {
    $first_video = $result->video_link;
} else {
    if ($stmt->rowCount() > 0) {
        $first_video = $results[0]->video_link;
    } else {
        $first_video = '';
    }
}

$query_comtd = "SELECT * FROM courses_enrolled 
WHERE user_id=? AND course_id=? AND completed=?";
$comtd_stmt = $pdo->prepare($query_comtd);
$comtd_stmt->execute([$USER_ID, $course_id, 1]);
$comtd_results = $comtd_stmt->fetchAll();

?>
<main id="main">
    <style>
        .fixed-top {
            position: sticky !important;
        }

        .suc h1 {
            color: #5fcf80;
        }

        .suc a {
            width: 50%;
            margin: 0 auto;
        }

        iframe {
            width: 100%;
            height: 70vh;
        }

        .video {
            padding: 10px 0px;
        }

        p.comtd {
            font-size: large;
            border: 2px solid blue;
            padding: 9px;
        }
    </style>
    <!-- ======= Breadcrumbs ======= -->

    <!-- End Breadcrumbs -->

    <!-- ======= Pricing Section ======= -->
    <section id="video" class="video">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="video">

                        <?= $first_video ?  $first_video : '<img style="width:100%;" src="./assets/img/novideo2.png" alt="">'; ?>
                        <!-- <iframe width="" src="https://www.youtube.com/embed/SQVMZyOLimI?rel=0&showinfo=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    </div>
                </div>
                <div class="col-lg-4 mt-sm-4 mt-lg-0">
                    <div class="header-outline mb-2">
                        <h4>Course outline</h4>
                    </div>
                    <?php
                    if ($stmt->rowCount() > 0) {
                        foreach ($results as $rs) { ?>
                            <a href="?module=pages&page=wvideo&course_id=<?= $course_id ?>&v_id=<?= $rs->id ?>">
                                <div class="d-flex justify-content-between ">
                                    <div>
                                        <p class="ml-5"> <i class='bx bx-play-circle'></i> <?= $rs->video_title ?></p>
                                    </div>
                                    <div>
                                        <p class="ml-5"> <i class='bx bx-time-five'></i> <?= round($rs->video_duration / 60, 2) ?>m</p>
                                    </div>
                                </div>
                            </a>
                    <?php
                        }
                    } else {
                        echo '<p>No video</p>';
                    }
                    ?>
                    <?=
                    $comtd_stmt->rowCount() > 0 ? '<p class="comtd mt-5 text-success">You have completed this course</p>' : '<a class="btn btn-primary mt-5" href="pages/complete-course-app.php?course_id=' . $course_id . ' &user_id=' . $USER_ID . '">Complete Course</a>'
                    ?>
                    <!-- <a href="#">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <p class="ml-5"> <i class='bx bx-play-circle'></i> luptatem optio quae</p>
                            </div>
                            <div>
                                <p class="ml-5"> <i class='bx bx-time-five'></i> 5m 36s</p>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <p class="ml-5"> <i class='bx bx-play-circle'></i> luptatem optio quae</p>
                            </div>
                            <div>
                                <p class="ml-5"> <i class='bx bx-time-five'></i> 5m 36s</p>
                            </div>
                        </div>
                    </a> -->
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Pricing Section -->
</main>