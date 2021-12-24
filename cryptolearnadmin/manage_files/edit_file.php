<?php
if (isset($_GET['id'])) {
    $file_id = $_GET['id'];
    $Query = "SELECT * FROM files WHERE id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$file_id]);
    $result = $stmt->fetch();

    $name = $result->file_name;
    $size = $result->file_size;
    $link = $result->file_link;
    $course_id = $result->course_id;
    $fid = $result->id;
    // var_dump($result);
} else {

    $name = '';
    $size = '';
    $link = '';
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
                <div class="name">
                    <h4>Edit File</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Files</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit file</li>
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
                        <h4 class="text-blue h5 pl-4 mb-10">Edit File</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>File Title</label>
                                    <input class="form-control form-control-lg" name="name" type="text" value="<?php echo $name?>">
                                </div>
                                <div class="form-group">
                                    <label>File</label>
                                    <input class="form-control form-control-lg" name="link" type="text" value="<?php echo $link?>">
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
                                    <label>File Size(mb)</label>
                                    <input class="form-control form-control-lg" name="size" type="number" value="<?php echo $size?>">
                                </div>
                                <!-- <div class="form-group">
                                    <label>Date Released</label>
                                    <input class="form-control form-control-lg" name="" type="date" value="20/05/2021">
                                </div> -->
                                <input type="hidden" name="id" value="<?php echo $fid?>">
                                <div class="form-group mb-0">
                                    <input name="submit" type="submit" class="btn btn-primary" value="Edit File">
                                    <input name="delete" type="submit" class="btn btn-danger float-right" value="Delete File">
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
    $name = $_POST['name'];
    $link = $_POST['link'];
    $course = $_POST['course'];
    $size = $_POST['size'];

    $Query3 = "UPDATE files SET file_name=?, file_size=?, file_link=?, course_id=? WHERE id=?";
    $stmt3 = $pdo->prepare($Query3);
    $status = $stmt3->execute([$name, $size, $link, $course, $id]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['file'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                File updated successfully,
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_files&page=files');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $Query4 = "DELETE FROM files WHERE id=?";
    $stmt4 = $pdo->prepare($Query4);
    $status4 = $stmt4->execute([$id]);

    if ($status4) {
        $_SESSION['delete'] = '
            <div class="m-2 alert alert-danger alert-dismissible fade show" role="alert">
                File deleted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_files&page=files');
    }
}
?>