<?php
$Query = "SELECT course_id,title FROM courses";
$stmt = $pdo->prepare($Query);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $results = $stmt->fetchAll();
}
?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Add Video</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Videos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add video</li>
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
                            <h4 class="text-blue h5 pl-4 mb-10">Add Video</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Video Title</label>
                                    <input class="form-control form-control-lg" name="title" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input class="form-control form-control-lg" name="link" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Course</label>
                                    <select class="form-control form-control-lg" name="course" id="">
                                        <option value="">Seleect an option</option>
                                        <?php
                                        foreach ($results as $cat) { ?>
                                            <option value="<?php echo $cat->course_id ?>"><?php echo $cat->title ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Video Duration</label>
                                    <input class="form-control form-control-lg" name="duration" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Video Size(mb)</label>
                                    <input class="form-control form-control-lg" name="size" type="number" value="">
                                </div>
                                <!-- <div class="form-group">
                                    <label>Date Added</label>
                                    <input class="form-control form-control-lg" name="" type="date" value="">
                                </div> -->

                                <div class="form-group mb-0">
                                    <input name="submit" type="submit" class="btn btn-primary" value="Add Video">
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
    $title = $_POST['title'];
    $course = $_POST['course'];
    $link = $_POST['link'];
    $duration = $_POST['duration'];
    $size = $_POST['size'];

    $Query2 = "INSERT INTO videos (video_title, video_link, video_duration, video_size, course_id) VALUES (?,?,?,?,?)";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute([$title, $link, $duration, $size, $course]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['video'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Video added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_videos&page=videos');
    }
}
?>