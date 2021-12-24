<!DOCTYPE html>
<html lang="en">

<?php
ob_start();

include 'config/constants.php';

if (isset($_SESSION['user_id'])) {
    $USER_ID = $_SESSION['user_id'];
} else {
    $USER_ID = '';
}

?>

<!-- head here -->
<?php
require_once 'includes/head.php';
?>

<body>

    <!-- ======= Header ======= -->
    <?php
    require_once 'includes/header.php';

    // if ($_SESSION['user_id'] == "") {
    //     if($_GET['module'] != 'dashboard'){
    //         header("Location: ./auth/login.php");
    //     }
    //     // exit;
    // }
    ?>


    <!-- End Header -->

    <!-- main -->
    <?php
    if (isset($_GET["module"])) {

        switch ($_GET["module"]) {
            case 'dashboard':
                $template = require_once "dashboard/dashboard.php";
                break;
            case 'pages':
                $template = require_once "pages/index.php";
                break;
            default:
                # code...
                break;
        }
    } else {
        require_once "dashboard/dashboard.php";
    }

    $template;


    ?>
    <!-- mainend -->

    <!-- ======= Footer ======= -->
    <?php
    require_once 'includes/footer.php'
    ?>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php
    require_once 'includes/scripts.php'
    ?>

</body>

</html>