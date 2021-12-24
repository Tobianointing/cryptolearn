<?php
if (!isset($_GET['page'])) {
    $_GET['page'] = '';
}

if ($USER_ID != '') {
    $id = $USER_ID;
    $Query = "SELECT * FROM users WHERE user_id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    $fname = $result->first_name;
    $lname = $result->last_name;
    $email = $result->email;
    $image = $result->image;
    $phone = $result->phone;
} else {
    $fname = '';
    $lname = '';
    $email = '';
    $image = '';
    $phone = '';
}
?>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="?module=dashboard&page=dashboard">CryptoLearn</a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        <?php
        if ($USER_ID) { ?>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="<?= $_GET['page'] == 'dashboard' ? 'active' : '' ?>" href="?module=dashboard&page=dashboard">Home</a></li>
                    <!-- <li><a href="about.html">About</a></li> -->
                    <li><a class="<?= $_GET['page'] == 'courses' ? 'active' : '' ?>" href="?module=pages&page=courses">Courses</a></li>
                    <!-- <li><a href="trainers.html">Trainers</a></li> -->
                    <li><a class="<?= $_GET['page'] == 'sub' ? 'active' : '' ?>" href="?module=pages&page=sub">Subcribe</a></li>
                    <li class="dropdown">
                        <a href="#">
                            <span><img class="header-img" src="<?php if ($image) {
                                                                    echo '../cryptolearnadmin/images/users/' . $image;
                                                                } else {
                                                                    echo 'https://themoneyafrica.com/images/default-avatar.png';
                                                                } ?>" alt="" />
                                <?= $fname . ' ' . $lname ?></span>
                            <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="?module=pages&page=userdash">Dashboard</a></li>
                            <li><a href="?module=pages&page=settings">Setting</a></li>
                            <li><a href="./auth/logout.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        <?php
        } else { ?>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="<?= $_GET['page'] == 'dashboard' ? 'active' : '' ?>" href="?module=dashboard&page=dashboard">Home</a></li>
                    <!-- <li><a href="about.html">About</a></li> -->
                    <li><a class="<?= $_GET['page'] == 'courses' ? 'active' : '' ?>" href="?module=pages&page=courses">Courses</a></li>
                    <!-- <li><a href="trainers.html">Trainers</a></li> -->
                    <li><a class="<?= $_GET['page'] == 'sub' ? 'active' : '' ?>" href="?module=pages&page=sub">Subcribe</a></li>
                    <li><a href="./auth/login.php">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <a href="./auth/register.php" class="get-started-btn">Register</a>
        <?php
        }
        ?>

        <!-- .navbar -->


    </div>
</header>