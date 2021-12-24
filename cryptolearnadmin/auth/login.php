<?php
if (isset($_POST["submit"])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = 'admin';
    $rawpassword = $_POST['password'];

    $sql = "SELECT CONCAT(first_name, ' ', last_name) as 'name', email, user_id, password FROM users WHERE (email= :email) and (user_type= :user_type)";
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email, 'user_type' => $user_type]);
    $results = $query->fetch();

    // var_dump($results);
    // echo $password;

    if ($query->rowCount() > 0) {
        if (password_verify($rawpassword, $results->password)) {
            $_SESSION['user_id'] = $results -> user_id;
            $_SESSION['name'] = $results -> name;
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["user_type"] = $user_type;
            header("Location:?module=dashboard&page=dashboard");
        } else {

            $_SESSION['error'] = 'Invalid Details';
            header("Location:?module=auth&page=login");
        }
    } else {
        $_SESSION['error'] = 'Invalid Details';
        header("Location:?module=auth&page=login");
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
    if (isset($_SESSION['error'])) { 
        $error = $_SESSION['error'];
        ?>
        <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
    }

    unset($_SESSION['error']);
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
                            <h2 class="text-center text-primary">Login To Admin</h2>
                        </div>
                        <form method="POST">
                            <div class="input-group custom">
                                <input type="email" class="form-control form-control-lg" name='email' placeholder="Email">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" name='password' placeholder="**********">
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