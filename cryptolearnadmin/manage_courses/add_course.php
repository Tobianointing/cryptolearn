<?php
$Query = "SELECT id,name FROM authors";
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
                    <h4>Add Course</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Courses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add course</li>
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
                            <h4 class="text-blue h5 pl-4 mb-10">Add Course</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control form-control-lg" name="title" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control form-control-lg" name="description" type="text" value="">
                                </div>
                               
                                <div class="form-group">
                                    <label>Author</label>
                                    <select class="form-control form-control-lg" name="author" id="">
                                        <option value="">Seleect an option</option>
                                        <?php
                                        foreach ($results as $cat) { ?>
                                            <option value="<?php echo $cat->id ?>"><?php echo $cat->name ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control form-control-lg" name="level" id="">
                                        <option value="">Seleect an option</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advance">Advance</option>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>Duration</label>
                                    <input class="form-control form-control-lg" name="duration" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Rating</label>
                                    <input class="form-control form-control-lg" name="rating" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <input class="form-control form-control-lg" name="cat" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input class="form-control form-control-lg" name="image" type="file" value="">
                                </div>
                                <div class="form-group">
                                    <label>No. of pple enrolled</label>
                                    <input class="form-control form-control-lg" name="no_of_pple_enrolled" type="number" value="">
                                </div>
                                <!-- <div class="form-group">
                                    <label>Released date</label>
                                    <input class="form-control form-control-lg" name="" type="text" value="">
                                </div> -->

                                <div class="form-group mb-0">
                                    <input name="submit" type="submit" class="btn btn-primary" value="Add Course">
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
    $description = $_POST['description'];
    $author = $_POST['author'];
    $level = $_POST['level'];
    $cat = $_POST['cat'];
    $rating = $_POST['rating'];
    $no_of_pple_enrolled = $_POST['no_of_pple_enrolled'];
    $duration = $_POST['duration'];

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

    $Query2 = "INSERT INTO courses (title, description, author_id, duration, level, category, rating, no_of_pple_enrolled, image) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute([$title, $description, $author, $duration, $level, $cat, $rating, $no_of_pple_enrolled, $image_name]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['course'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Course added successfully,
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_courses&page=courses');
    }
}
?>