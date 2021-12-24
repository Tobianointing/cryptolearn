<?php
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = 'admin';


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
                $msg = "You have signup Successfully";
                $_SESSION['msg'] = $msg;
                header("Location:?module=auth&page=login");
            } else {
                $error = "Something wrong here. Try again";
                $_SESSION['error'] = $error;
                header("Location:?module=auth&page=register");

            }
        } else {
            $error = "User already exist.";
            $_SESSION['error'] = $error;
            header("Location:?module=auth&page=register");
        }
    } else {
        $_SESSION['error'] = 'passsword not matched';
        header("Location:?module=auth&page=register");
    }
}
?>
<div class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="font-weight-bolder h3 p-3">

                CryptoLearn - Admin

            </div>
        </div>
    </div>
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
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/login-page-img.png" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Register Admin</h2>
                        </div>
                        <form method="POST">
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" name='firstname' placeholder="firstname">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" name='lastname' placeholder="lastname">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="tel" class="form-control form-control-lg" name='phone' placeholder="phone">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" name='email' placeholder="Email">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" name='password' placeholder="password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" name='cpassword' placeholder="confirm password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">

                                        <input class="btn btn-primary btn-lg btn-block" name='submit' type="submit" value="Sign In">

                                        <!-- <a class="btn btn-primary btn-lg btn-block" href="index.html">Log In</a> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


