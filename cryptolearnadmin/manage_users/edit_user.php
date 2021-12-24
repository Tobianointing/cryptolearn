<?php
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $Query = "SELECT * FROM users WHERE user_id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$user_id]);
    $result = $stmt->fetch();

    $fname = $result->first_name;
    $lname = $result->last_name;
    $phone = $result->phone;
    $email = $result->email;
    $image = $result->image;
} else {
    $fname = '';
    $lname = '';
    $phone = '';
    $email = '';
}

?>
<?php
if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
?>

<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>User Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit user</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box">
                <div class="profile-photo">
                    <img src="<?= $image ? 'images/users/'.$image : 'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg'?>" alt="" class="avatar-photo">
                </div>
                <h5 class="text-center h5 mb-0"><?php $fname . ' ' . $lname ?></h5>
            </div>

            <div class="pd-20 mt-3 card-box">
                <form>
                    <div class="form-group">
                        <label>Subcribed Plans</label>
                        <ul>
                            <li>advance - 5000/mon</li>
                            <li>beginners - 8000/mon</li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-setting">
                    <form method="POST" enctype="multipart/form-data">
                        <ul class="profile-edit-list row">
                            <h4 class="text-blue h5 pl-4 mb-10">Edit Profile</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control form-control-lg" type="text" name="fname" value="<?= $fname ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control form-control-lg" type="text" name="lname" value="<?= $lname ?>">
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input class="form-control form-control-lg" type="text" name="phone" value="<?= $phone ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control form-control-lg" type="email" name="email" value="<?= $email ?>">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input class="form-control form-control-lg" name="image" type="file" value="">
                                </div>

                                <input type="hidden" name="id" value="<?php echo $user_id ?>">

                                <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1-1" checked>
                                        <label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
                                    </div>
                                </div> -->

                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update Information">
                                    <input type="submit" name="delete" class="btn btn-danger float-right" value="Delete Account">
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
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != '') {
            $ext = end(explode('.', $image_name));

            $image_name = 'user' . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "images/users/" . $image_name;

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
                header('location: ?module=manage_users&page=edit_user');
            }
        } else {
            $image_name = $image;
        }
    } else {
        $image_name = $image;
    }

    $Query2 = "UPDATE users SET first_name=:fname, last_name=:lname, phone=:phone, email=:email, image=:image WHERE user_id=:id";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute(['fname' => $fname, 'lname' => $lname, 'phone' => $phone, 'email' => $email, 'image' => $image_name, 'id' => $user_id]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['image'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Account updated successfully,
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_users&page=users');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $Query3 = "DELETE FROM users WHERE user_id=?";
    $stmt3 = $pdo->prepare($Query3);
    $status2 = $stmt3->execute([$id]);

    if ($status2) {
        $_SESSION['delete'] = '
            <div class="m-2 alert alert-danger alert-dismissible fade show" role="alert">
                User deleted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_users&page=users');
    }
}
?>