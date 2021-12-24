<?php
if (isset($_GET['id'])) {
    $author_id = $_GET['id'];
    $Query = "SELECT * FROM authors WHERE id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$author_id]);
    $result = $stmt->fetch();

    $name = $result->name;
    $about = $result->about;
    $image = $result->author_image;
    $aid = $result->id;
    // var_dump($result);
} else {
    $name = '';
    $about = '';
    $image = '';
}

?>

<style>
    /* .img-div{

    } */
    .img-author {
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }
</style>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Edit Author</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Authors</a></li>
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

                    <div class="img-div text-center m-3">
                        <img class="img-author" src="<?php
                        if($image){
                            echo './images/authors/'. $image;
                        }else{
                            echo 'vendors/images/img.jpg';
                        }
                        ?>" alt="">
                    </div>

                    <form method="post" enctype="multipart/form-data">
                        <ul class="profile-edit-list row">
                            <h4 class="text-blue h5 pl-4 mb-10">Edit Author</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Author Name</label>
                                    <input class="form-control form-control-lg" name="name" type="text" value="<?php echo $name ?>">
                                </div>
                                <div class="form-group">
                                    <label>About Author</label>
                                    <input class="form-control form-control-lg" name="about" type="text" value="<?php echo $about ?>">
                                </div>

                                <div class="form-group">
                                    <label>Author Image</label>
                                    <input class="form-control form-control-lg" name="image" type="file" value="">
                                </div>
                                <input type="hidden" value="<?php echo $aid ?>" name="id">
                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Edit Author">
                                    <input type="submit" name="delete" class="btn btn-danger float-right" value="Delete Author">
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
    $about = $_POST['about'];
    $name = $_POST['name'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != '') {
            $ext = end(explode('.', $image_name));

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

    $Query3 = "UPDATE authors SET name=?, about=?, author_image=? WHERE id=?";
    $stmt3 = $pdo->prepare($Query3);
    $status = $stmt3->execute([$name, $about, $image_name, $id]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['author'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Author updated successfully,
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_authors&page=authors');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $Query4 = "DELETE FROM authors WHERE id=?";
    $stmt4 = $pdo->prepare($Query4);
    $status4 = $stmt4->execute([$id]);

    if ($status4) {
        $_SESSION['delete'] = '
            <div class="m-2 alert alert-danger alert-dismissible fade show" role="alert">
                Author deleted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_authors&page=authors');
    }
}
?>