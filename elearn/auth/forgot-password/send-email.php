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
            <h1 class="logo me-auto"><a href="index.html">CryptoLearn</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
    </header>

    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../../vendor/autoload.php';

    include '../../config/constants.php';


    if (isset($_POST["email"]) && (!empty($_POST["email"]))) {
        $email = $_POST["email"];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $error = "";
        if (!$email) {
            $error .= "<p>Invalid email address please type a valid email address!</p>";
        } else {
            $sel_query = "SELECT * FROM users WHERE email=?";
            $stmt = $pdo->prepare($sel_query);
            $stmt->execute([$email]);
            $results = $stmt->fetchAll();

            if ($stmt->rowCount() < 0) {
                $error .= "<p>No user is registered with this email address!</p>";
            }
        }
        if ($error != "") {
            echo "<div class='error'>" . $error . "</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
        } else {
            $expFormat = mktime(
                date("H"),
                date("i"),
                date("s"),
                date("m"),
                date("d") + 1,
                date("Y")
            );
            $expDate = date("Y-m-d H:i:s", $expFormat);
            $key = md5(2418 * 2 . $email);
            $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
            $key = $key . $addKey;

            // Insert Temp Table
            $inr_query = "INSERT INTO password_reset_temp (email, token, expDate) VALUES (?,?,?)";
            $inr_stmt = $pdo->prepare($inr_query);
            $inr_stmt->execute([$email, $key, $expDate]);

            $output = '<p>Dear user,</p>';
            $output .= '<p>Please click on the following link to reset your password.</p>';
            $output .= '<p>-------------------------------------------------------------</p>';
            $output .= '<p><a href="http://localhost/cryptolearn/elearn/auth/forgot-password/reset-password.php?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
        http://localhost/cryptolearn/elearn/auth/forgot-password/reset-password.php
        ?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
            $output .= '<p>-------------------------------------------------------------</p>';
            $output .= '<p>Please be sure to copy the entire link into your browser.
        The link will expire after 1 day for security reason.</p>';
            $output .= '<p>If you did not request this forgotten password email, no action 
        is needed, your password will not be reset. However, you may want to log into 
        your account and change your security password as someone may have guessed it.</p>';
            $output .= '<p>Thanks,</p>';
            $output .= '<p>Cryptolearn Team</p>';
            $body = $output;
            $subject = "Password Recovery - Cryptolearn.com";

            $email_to = $email;
            $fromserver = "elementkayode@gmail.com";
            // require("PHPMailer/PHPMailerAutoload.php");
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com"; // Enter your host here
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "elementkayode@gmail.com"; // Enter your email here
            $mail->Password = "Tobi1999#"; //Enter your password here

            $mail->IsHTML(true);
            $mail->setFrom("elementkayode@gmail.com");
            $mail->FromName = "Cryptolearn";
            $mail->Sender = $fromserver; // indicates ReturnPath header
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->addAddress($email_to);
            if (!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else { ?>
                <main id="main">
                    <section id="pricing" class="pricing">
                        <div class="container">
                            <div class="d-flex  suc justify-content-center flex-column">
                                <h1 class="align-self-center text-center">
                                    An email has been sent to you with instructions on how to reset your password.
                                </h1>
                            </div>
                        </div>
                    </section>
                </main>
        <?php
            }
        }
    } else {
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

                                <form action="" method="post" name="reset" role="form" class="php-email-form">
                                    <label for="">Enter Email:</label>
                                    <div class="form-group mt-1">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                    </div>

                                    <div class="text-center"><input class="mt-3 btn btn-success" name="submit" type="submit" value="Reset Password"></div>
                                    <p class="text-center mt-3">Remember password? <a href="../login.php">Login</a></p>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>
            </section>
        </main>

    <?php } ?>
</body>

</html>