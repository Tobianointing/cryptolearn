<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Reset password</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../../assets/img/favicon.png" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">

    <style>
        .fixed-top {
            position: sticky !important;
        }

        .suc h1 {
            color: #5fcf80;
        }

        .suc a {
            width: 50%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="../login.php">CryptoLearn</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
    </header>

    <?php
    include '../../config/constants.php';
    // die("i reach here");

    $error = "";

    if (
        isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"])
        && ($_GET["action"] == "reset") && !isset($_POST["action"])
    ) {
        $key = $_GET["key"];
        $email = $_GET["email"];
        $curDate = date("Y-m-d H:i:s");



        $sel_query = "SELECT * FROM password_reset_temp WHERE token=? AND email=?";
        $stmt = $pdo->prepare($sel_query);
        $stmt->execute([$key, $email]);
        $results = $stmt->fetch();

        if ($stmt->rowCount() <= 0) {
            $error .= '<h2>Invalid Link</h2>
        <p>The link is invalid/expired. Either you did not copy the correct link
        from the email, or you have already used the key in which case it is 
        deactivated.</p>
        <p><a href="http://localhost/cryptolearn/elearn/auth/forgot-password/send-email.php">
        Click here</a> to reset password.</p>';
        } else {
            $expDate = $results->expDate;
            if ($expDate >= $curDate) {
    ?>
                <main id="main">
                    <section id="contact" class="contact">

                        <div class="container">

                            <div class="row justify-content-between">

                                <div class="col-lg-4 mx-auto mt-sm-3 mt-lg-5">
                                    <div class="card p-3">
                                        <div class="img text-center">
                                            <img class="mx-auto text-center" style="width:50%;" src="https://thumbs.dreamstime.com/b/locker-icon-vector-padlock-symbol-key-lock-illustration-privacy-password-safety-security-protection-locked-secure-116341435.jpg" alt="">
                                        </div>

                                        <form action="" method="post" name="update" role="form" class="php-email-form">
                                            <input type="hidden" name="action" value="update" />
                                            <label for="">New Password:</label>
                                            <div class="form-group mt-1">
                                                <input type="password" class="form-control" name="pass1" minlength="6" id="password" placeholder="******" required>
                                            </div>

                                            <label for="">Re-Enter Pasword:</label>
                                            <div class="form-group mt-1">
                                                <input type="password" class="form-control" name="pass2" minlength="6" id="password" placeholder="******" required>
                                            </div>

                                            <input type="hidden" name="email" value="<?php echo $email; ?>" />
                                            <div class="text-center"><input class="mt-3 btn btn-success" name="submit" type="submit" value="Reset Password"></div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </section>
                </main>

            <?php
            } else {
                $error .= "<h2>Link Expired</h2>
                <p>The link is expired. You are trying to use the expired link which 
                as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
        }
        if ($error != "") { ?>
            <main id="main">
                <section id="pricing" class="pricing">
                    <div class="container">
                        <div class="d-flex  suc justify-content-center flex-column">
                            <h1 class="align-self-center text-center">
                                <?= $error ?>
                            </h1>
                        </div>
                    </div>
                </section>
            </main>
           
        <?php
        }
    } else {
        // die("i reach here");
    } // isset email key validate end


    if (
        isset($_POST["email"]) && isset($_POST["action"]) &&
        ($_POST["action"] == "update")
    ) {
        $error = "";
        $pass1 = $_POST["pass1"];
        $pass2 = $_POST["pass2"];
        $email = $_POST["email"];
        $curDate = date("Y-m-d H:i:s");
        if ($pass1 != $pass2) {
            $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
        }
        if ($error != "") {
            echo "<div class='error'>" . $error . "</div><br />";
        } else {
            $pass1 = password_hash($pass1, PASSWORD_DEFAULT);

            $pwd_query = "UPDATE users SET password=? WHERE email=?";
            $pwd_stmt = $pdo->prepare($pwd_query);
            $pwd_stmt->execute([$pass1, $email]);

            $del_query = "DELETE FROM password_reset_temp WHERE email=?";
            $del_stmt = $pdo->prepare($del_query);
            $del_stmt->execute([$email]); ?>

            <main id="main">
                <section id="pricing" class="pricing">
                    <div class="container">
                        <div class="d-flex  suc justify-content-center flex-column">
                            <h1 class="align-self-center text-center">
                                Congratulations! Your password has been updated successfully.</p>
                                <p><a class="text-primary" href="http://localhost/cryptolearn/elearn/auth/login.php">
                                        Click here</a> to Login.</p>
                            </h1>
                        </div>
                    </div>
                </section>
            </main>

    <?php }
    }
    ?>
</body>

</html>