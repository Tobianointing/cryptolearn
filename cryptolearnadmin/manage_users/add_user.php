<?php
// unset($_SESSION['error']);
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = 'user';


    if ($password == $cpassword) {

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $checkQuery = "SELECT * FROM users where (email=?)";
        $check = $pdo->prepare($checkQuery);
        $check->execute([$email]);
        $results = $check->fetchAll();

        if ($check->rowCount() == 0) {
            $sql = "INSERT INTO users (first_name, last_name, phone, email, user_type,  password) VALUES(?, ?, ?, ?, ?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute([$firstname, $lastname, $phone, $email, $user_type, $password]);
            $lastInsertId = $pdo->lastInsertId();
            if ($lastInsertId) {
                $_SESSION['msg'] = '
                <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    User successfully added.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
                header("Location:?module=manage_users&page=users");
            } else {
                $error = "Something wrong here. Try again";
                $_SESSION['error'] = $error;
                header("Location:?module=manage_users&page=add_user");
            }
        } else {
            $error = "User already exist.";
            $_SESSION['error'] = $error;
            header("Location:?module=manage_users&page=add_user");
        }
    } else {
        $_SESSION['error'] = 'passsword not matched';
        header("Location:?module=manage_users&page=add_user");
    }
}
?>

<?php
if (isset($_SESSION['error'])) { ?>
    <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}

// unset($_SESSION['error']);
?>

<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 mb-30">
    <div class="card-box height-100-p overflow-hidden">
        <div class="profile-setting">
            <form method="POST">
                <ul class="profile-edit-list row">
                    <h4 class="text-blue h5 pl-4 mb-10">Add User</h4>
                    <li class="weight-500 col-md-12">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control form-control-lg" name="firstname" type="text">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control form-control-lg" name="lastname" type="text">
                        </div>
                        <div class="form-group">
                            <label>Phone number</label>
                            <input class="form-control form-control-lg" name="phone" type="text">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control form-control-lg" name="email" type="email">
                        </div>
                        <!-- <div class="form-group">
                            <label>Profile picture</label>
                            <input class="form-control form-control-lg" name="image" type="file" value="">
                        </div> -->
                        <!-- <div class="form-group">
                            <label>Gender</label>
                            <div class="d-flex">
                            <div class="custom-control custom-radio mb-5 mr-20">
                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                            </div>
                            </div>
                        </div>                       

                        <div class="form-group">
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                <label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
                            </div>
                        </div> -->

                        <div class="form-group mt-5">
                            <label>Password</label>
                            <input class="form-control form-control-lg" name="password" type="password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control form-control-lg" name="cpassword" type="password">
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Acount">
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>