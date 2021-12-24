
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="name">
                    <h4>Add Author</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Authors</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add author</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-setting">
                    <form method="post"  enctype="multipart/form-data">  
                        <ul class="profile-edit-list row">
                            <h4 class="text-blue h5 pl-4 mb-10">Add Author</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Author Name</label>
                                    <input class="form-control form-control-lg" name="name" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Author Image</label>
                                    <input class="form-control form-control-lg" name="image" type="file" value="">
                                </div>
                                
                                <div class="form-group">
                                    <label>About Author</label>
                                    <input class="form-control form-control-lg" name="about" type="text" value="">
                                </div>

                                <div class="form-group mb-0">
                                    <input name="submit" type="submit" class="btn btn-primary" value="Add Author">
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
    $name = $_POST['name'];
    $about = $_POST['about'];
    $image = '';

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != '') {
            $ext = end(explode('.', $image_name));
            // die($ext);

            $image_name = 'author' . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "images/authors/" . $image_name;

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

    $Query2 = "INSERT INTO authors (name, about, author_image) VALUES (?,?,?)";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute([$name, $about, $image_name]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['author'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Author added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_authors&page=authors');
    }
}
?>