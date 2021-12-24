<?php
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $Query = "SELECT * FROM courses WHERE course_id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$course_id]);
    $result = $stmt->fetch();

    $title = $result->title;
    $author_id = $result->author_id;
    $description = $result->description;
    $duration = $result->duration;
    $rating = $result->rating;
    $category = $result->category;
    $no_of_pple_enrolled = $result->no_of_pple_enrolled;
    $level = $result->level;
    $released_date = $result->released_date;
    $image = $result->image;
} else {

    $title = '';
    $author = '';
    $description = '';
    $duration = '';
    $rating = '';
    $category = '';
    $no_of_pple_enrolled = '';
    $level = '';
    $released_date = '';
}

$Query2 = "SELECT id,name FROM authors";
$stmt2 = $pdo->prepare($Query2);
$stmt2->execute();

if ($stmt2->rowCount() > 0) {
    $results2 = $stmt2->fetchAll();
}

$level_array =  array('Beginner', 'Intermediate', 'Advance');

?>

<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Edit Course</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Courses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit course</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-setting">
                    <form method="post" enctype="multipart/form-data">
                        <ul class="profile-edit-list row">
                            <h4 class="text-blue h5 pl-4 mb-10">Edit Course</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control form-control-lg" name="title" type="text" value="<?php echo $title ?>">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control form-control-lg" name="description" type="text" value="<?php echo $description ?>">
                                </div>
                                <div class="form-group">
                                    <label>Course</label>
                                    <select class="form-control form-control-lg" name="author" id="">
                                        <option value="">Select author</option>
                                        <?php

                                        foreach ($results2 as $author) {
                                            // echo $author;
                                            if ($author->id == $author_id) {
                                                echo '<option value="' . $author->id . '" selected>' . $author->name . '</option>';
                                            } else {
                                                echo '<option value="' . $author->id . '">' . $author->name . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control form-control-lg" name="level" id="">
                                        <?php
                                        foreach ($level_array as $l) {
                                            if ($level == $l) {
                                                echo '<option value="' . $level . '" selected>' . $level . '</option>';
                                            } else {
                                                echo '<option value="' . $l . '">' . $l . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Duration</label>
                                    <input class="form-control form-control-lg" name="duration" type="text" value="<?php echo $duration ?>">
                                </div>
                                <div class="form-group">
                                    <label>Rating</label>
                                    <input class="form-control form-control-lg" name="rating" type="text" value="<?php echo $rating ?>">
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <input class="form-control form-control-lg" name="cat" type="text" value="<?php echo $category ?>">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input class="form-control form-control-lg" name="image" type="file" value="">
                                </div>
                                <div class="form-group">
                                    <label>No. of pple enrolled</label>
                                    <input class="form-control form-control-lg" name="no_of_pple_enrolled" type="number" value="<?php echo $no_of_pple_enrolled ?>">
                                </div>
                                <!-- <div class="form-group">
                                    <label>Released date</label>
                                    <input class="form-control form-control-lg" type="text" value="">
                                </div> -->
                                <input type="hidden" name="id" value="<?php echo $course_id ?>">

                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update Course">
                                    <input type="submit" name="delete" class="btn btn-danger float-right" value="Delete Course">
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
    $description = $_POST['description'];
    $author = $_POST['author'];
    $level = $_POST['level'];
    $cat = $_POST['cat'];
    $rating = $_POST['rating'];
    $duration = $_POST['duration'];
    $no_of_pple_enrolled = $_POST['no_of_pple_enrolled'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != '') {
            $ext = end(explode('.', $image_name));

            $image_name = 'course' . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "images/courses/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == false) {
                $_SESSION['uplaod'] = '
                <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    image failed to upload.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
                header('location: ?module=manage_courses&page=edit_course');
            }
        } else {
            $image_name = $image;
        }
    } else {
        $image_name = $image;
    }

    $Query2 = "UPDATE courses SET title=?, description=?, author_id=?, duration=?, level=?, category=?, rating=?, no_of_pple_enrolled=?, image=? WHERE course_id=?";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute([$title, $description, $author, $duration, $level, $cat, $rating, $no_of_pple_enrolled, $image_name, $id]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['course'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Course updated successfully,
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_courses&page=courses');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $Query3 = "DELETE FROM courses WHERE course_id=?";
    $stmt3 = $pdo->prepare($Query3);
    $status2 = $stmt3->execute([$id]);

    if ($status2) {
        $_SESSION['delete'] = '
            <div class="m-2 alert alert-danger alert-dismissible fade show" role="alert">
                Course deleted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_courses&page=courses');
    }
}
?>