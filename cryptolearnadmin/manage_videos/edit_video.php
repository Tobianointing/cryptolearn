<?php
if (isset($_GET['id'])) {
    $video_id = $_GET['id'];
    $Query = "SELECT * FROM videos WHERE id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$video_id]);
    $result = $stmt->fetch();

    $title = $result->video_title;
    $size = $result->video_size;
    $link = $result->video_link;
    $duration = $result->video_duration;
    $course_id = $result->course_id;
    $vid = $result->id;
    // var_dump($result);
} else {

    $title = '';
    $size = '';
    $link = '';
    $duration = '';
    $course_id = '';
}

$Query2 = "SELECT course_id,title FROM courses";
$stmt2 = $pdo->prepare($Query2);
$stmt2->execute();

if ($stmt2->rowCount() > 0) {
    $results2 = $stmt2->fetchAll();
}
// var_dump($results2)
?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Edit Video</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Videos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit video</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-setting">
                    <form method="post">
                        <ul class="profile-edit-list row">
                            <h4 class="text-blue h5 pl-4 mb-10">Edit Video</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Video Title</label>
                                    <input class="form-control form-control-lg" name="title" type="text" value="<?php echo $title ?>">
                                </div>
                                <div class="form-group">
                                    <label>Video link</label>
                                    <textarea class="form-control form-control-lg" name="link" cols="30" rows="5" value="<?php echo $link ?>"><?php echo $link ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Course</label>
                                    <select class="form-control form-control-lg" name="course" id="">
                                        <option value="">Select course</option>
                                        <?php

                                        foreach ($results2 as $course) {
                                            // echo $course;
                                            if ($course->course_id == $course_id) {
                                                echo '<option value="' . $course->course_id . '" selected>' . $course->title . '</option>';
                                            } else {
                                                echo '<option value="' . $course->course_id . '">' . $course->title . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Video Duration</label>
                                    <input class="form-control form-control-lg" name="duration" type="number" value="<?php echo $duration ?>">
                                </div>
                                <div class="form-group">
                                    <label>Video Size(mb)</label>
                                    <input class="form-control form-control-lg" name="size" type="number" value="<?php echo $size ?>">
                                </div>
                                <input type="hidden" value="<?php echo $vid ?>" name="id">
                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Edit Video">
                                    <input type="submit" name="delete" class="btn btn-danger float-right" value="Delete Video">
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $link = $_POST['link'];
    $duration = $_POST['duration'];
    $course = $_POST['course'];
    $size = $_POST['size'];

    $Query3 = "UPDATE videos SET video_title=?, video_duration=?, video_size=?, video_link=?, course_id=? WHERE id=?";
    $stmt3 = $pdo->prepare($Query3);
    $status = $stmt3->execute([$title, $duration, $size, $link, $course, $id]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['video'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Video updated successfully,
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_videos&page=videos');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $Query4 = "DELETE FROM videos WHERE id=?";
    $stmt4 = $pdo->prepare($Query4);
    $status4 = $stmt4->execute([$id]);

    if ($status4) {
        $_SESSION['delete'] = '
            <div class="m-2 alert alert-danger alert-dismissible fade show" role="alert">
                Video deleted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_videos&page=videos');
    }
}
?>