<?php
require_once 'config/redirect.php';

if (isset($USER_ID)) {
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

<main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="padding-top: 50px">
        <div class="container" data-aos="fade-up">
            <div class="row mt-5">
                <div class="col-lg-7">
                    <?php
                    if (isset($_SESSION['upload'])) {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    } elseif (isset($_SESSION['image'])) {
                        echo $_SESSION['image'];
                        unset($_SESSION['image']);
                    } elseif (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    } elseif (isset($_SESSION['pwd'])) {
                        echo $_SESSION['pwd'];
                        unset($_SESSION['pwd']);
                    }
                    ?>
                    <div class="card p-3">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                    Profile
                                </button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                    Change password
                                </button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    Manage subscriptions
                                </button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="profile-img mt-3 ml-5">
                                    <img src="<?php if ($image) {
                                                    echo '../cryptolearnadmin/images/users/' . $image;
                                                } else {
                                                    echo 'https://themoneyafrica.com/images/default-avatar.png';
                                                } ?>" alt="" />
                                </div>
                                <form action="pages/updateapp.php" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <div class="col-md-6 form-group">
                                            <label>First Name</label>
                                            <input type="text" name="fname" class="form-control" id="fname" value="<?= $fname ?>" />
                                        </div>
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="lname" id="email" value="<?= $lname ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?= $email ?>" />
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Phone</label>
                                        <input type="tel" class="form-control" name="phone" id="phone" value="<?= $phone ?>" />
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="image" />
                                    </div>

                                    <input type="hidden" name="img-data" value="<?= $image ?>">

                                    <div class="text-center">
                                        <input class="btn btn-success" type="submit" name="submit" value="Update">
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form action="pages/changepwdapp.php" method="post" role="form" class="php-email-form">
                                    <div class="form-group mt-3">
                                        <label>Current Password</label>
                                        <input type="password" class="form-control" name="currpassword" id="currpassword" placeholder="Current Password" required />
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required />
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Re-enter Password</label>
                                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Re-enter Password" required />
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" class="btn btn-success" name="submit" value="Change password">
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="for-sub mt-3">
                                    <div class="">
                                        <i class="bx bx-money"></i>
                                    </div>
                                    <div class="second ml-4">
                                        <span>N1000/6 month</span>
                                    </div>
                                </div>
                                <div class="for-sub mt-3">
                                    <div class="">
                                        <i class="bx bx-money"></i>
                                    </div>
                                    <div class="second ml-4">
                                        <span>N1000/6 month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Section -->
</main>