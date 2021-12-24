<?php
include '../config/constants.php';

if (isset($_GET['ref_code']) && $_GET['ref_code'] != "") {
    $ref_code = $_GET['ref_code'];
} else {
    $ref_code = 0;
}

if (isset($_POST['submit'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
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
            $sql = "INSERT INTO users (first_name, last_name, phone, email, user_type,  password, referral_code) VALUES(?, ?, ?, ?, ?, ?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute([$firstname, $lastname, $phone, $email, $user_type, $password, $ref_code]);
            $lastInsertId = $pdo->lastInsertId();

            if ($lastInsertId) {

                $_SESSION['msg'] = '
                <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    User successfully added.
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
                header("Location: ../auth/login.php");
            } else {
                $_SESSION['error'] = '
                <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    Something wrong here. Try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
                $ref_code == 0 ? header("Location: ../auth/register.php") : header("Location: ../auth/register.php?ref_code={$ref_code}");
            }
        } else {
            $_SESSION['error'] = '
            <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                User already exist.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
            $ref_code == 0 ? header("Location: ../auth/register.php") : header("Location: ../auth/register.php?ref_code={$ref_code}");
        }
    } else {
        $_SESSION['error'] = '
        <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
            passsword not matched.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ';
        $ref_code == 0 ? header("Location: ../auth/register.php") : header("Location: ../auth/register.php?ref_code={$ref_code}");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CryptoLearn</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: CryptoLearn - v4.3.0
  * Template URL: https://bootstrapmade.com/CryptoLearn-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        label {
            font-size: small;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="../?module=dashboard&page=dashboard">CryptoLearn</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"></a>-->


        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs" data-aos="fade-in">
            <div class="container">
                <h2>Register</h2>
            </div>
        </div><!-- End Breadcrumbs -->
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } elseif (isset($_SESSION['image'])) {
            echo $_SESSION['image'];
            unset($_SESSION['image']);
        } elseif (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        } elseif (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <div class="row mt-5 justify-content-between">
                    <div class="col-lg-6 d-sm-none d-lg-flex">
                        <img src="../assets/img/signup.jpg" alt="" style="width: 100%;">
                    </div>

                    <div class="col-lg-4 mt-5  mt-lg-0">

                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="php-email-form">
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <label>First Name</label>
                                    <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" />
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" />
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="email" />
                            </div>

                            <div class="form-group mt-3">
                                <label>Phone</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="phone" />
                            </div>

                            <div class="form-group mt-3">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>

                            <div class="form-group mt-3">
                                <label>Confirm password</label>
                                <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm password" required>
                            </div>

                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>

                            <div class="text-center"><button name="submit" type="submit">Register</button></div>
                            <p class="text-center mt-3">Already have an account? <a href="./login.php">Login</a></p>
                        </form>

                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->


    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/purecounter/purecounter.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>