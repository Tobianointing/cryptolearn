<?php
require_once 'config/redirect.php';

$query = "SELECT DISTINCT sub_history.status,
subscriptions.amount,
subscriptions.name,
subscriptions.duration
FROM sub_history
INNER JOIN subscriptions ON subscriptions.sub_id=sub_history.sub_id
WHERE sub_history.user_id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$USER_ID]);
$sub_results = $stmt->fetchAll();
$sub_total = $stmt->rowCount();

$cus_query = "SELECT * FROM courses_enrolled 
INNER JOIN courses ON courses.course_id=courses_enrolled.course_id
WHERE user_id=?
ORDER BY courses_enrolled.date DESC";
$stmt_cus = $pdo->prepare($cus_query);
$stmt_cus->execute([$USER_ID]);
$cus_total = $stmt_cus->rowCount();
$cus_results = $stmt_cus->fetchAll();

$queryimg = "SELECT user_id, image, CONCAT(first_name, ' ', last_name) AS name
FROM users
WHERE user_id=?";
$stmt_img = $pdo->prepare($queryimg);
$stmt_img->execute([$USER_ID]);
$r_img = $stmt_img->fetch();

$query_comtd = "SELECT * FROM courses_enrolled 
INNER JOIN courses ON courses.course_id=courses_enrolled.course_id
WHERE user_id=? AND completed=?";
$comtd_stmt = $pdo->prepare($query_comtd);
$comtd_stmt->execute([$USER_ID, 1]);
$comtd_results = $comtd_stmt->fetchAll();
?>

<style>
    span.status {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        display: inline-block;
        margin-left: 8px;
    }
    .ref-icon {
        cursor: pointer;
    }
</style>
<main id="main">
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="padding-top: 50px">
        <div class="container" data-aos="fade-up">
            <div class="row mt-5">
                <div class="col-lg-5">
                    <div class="dashprofile card">
                        <div class="text-center mt-3">
                            <img src="<?= $r_img->image ? '../cryptolearnadmin/images/users/' . $r_img->image : 'https://themoneyafrica.com/images/default-avatar.png' ?>" alt="" />
                            <p><?= $r_img->name ?></p>
                            <a href="?module=pages&page=settings">Account Settings</a>
                        </div>

                        <div class="dash-courses mt-4">
                            <div class="course-inner d-flex justify-content-between">
                                <span><i class="bx bx-receipt"></i> Courses Picked</span>
                                <span class="num-span text-success"><?= $cus_total  ?></span>
                            </div>
                            <div class="course-inner d-flex justify-content-between">
                                <span><i class="bx bx-receipt"></i> Courses Completed</span>
                                <span class="num-span text-success"><?= $comtd_stmt->rowCount() > 0 ? $comtd_stmt->rowCount() : 0 ?></span>
                            </div>
                        </div>

                        <div class=" row p-2 mt-3">
                            <p class="mb-2">Referral Link</p>
                            <div class="col-10">
                                <input id="copy" class="form-control" type="text " value="http://localhost/cryptolearn/elearn/auth/register.php?ref_code=<?= $r_img->user_id ?>" readonly>
                            </div>
                            <div class="col-2">
                                <div class="ml-3 align-self-center ref-icon" data-toggle="tooltip" data-placement="top" title="Copy" onclick="Copy()">
                                    <i class='bx bx-copy'></i>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3 p-3">
                            <p class="mb-2">Referral Balance</p>

                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="balance" id="balance" value="10,000" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <input class="btn btn-success" name="submit" type="submit" value="Withdraw">
                            </div>


                        </div>

                        <div class="sub mt-4 ml-4">Your Subscriptions</div>
                        <div class="tab-content row g-2 px-3 py-2">
                            <?php
                            foreach ($sub_results as $sr) {
                            ?>
                                <div class="col-6">
                                    <div class="for-sub mb-2">
                                        <div class="">
                                            <i class="bx bx-money"></i>
                                        </div>
                                        <div class="second ml-4">
                                            <span>N<?= $sr->amount ?>/<?= $sr->duration ?> month</span> <?= $sr->status == 1 ? '<span class="ml-5 status bg-success"></span>' : '<span class="ml-5 status bg-danger"></span>' ?>
                                        </div>
                                    </div>
                                </div>


                            <?php
                            }
                            ?>

                        </div>

                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card">
                        <div class="courses ">
                            <div class="course-inner mb-2 d-flex justify-content-between">
                                <span> Courses Picked</span>
                                <span class="num-span text-success"><?= $cus_total ?> courses</span>
                            </div>

                            <div class="row  g-3 px-4 pb-3" data-aos="zoom-in" data-aos-delay="100">
                                <?php
                                if ($stmt_cus->rowCount() > 0) {

                                    foreach ($cus_results as $crs) { ?>
                                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                            <div class="course-item">
                                                <img src="../cryptolearnadmin/images/courses/<?= $crs->image ? $crs->image : 'course216.jpg' ?>" class="img-fluid" alt="..." />
                                                <div class="course-content">
                                                    <div class="
                                                d-flex
                                                justify-content-between
                                                align-items-center
                                                mb-3
                                                ">
                                                        <h4><?= $crs->category ?></h4>
                                                    </div>

                                                    <h3>
                                                        <a href="pages/validatesub.php?id=<?= $crs->course_id ?>&level=<?= $crs->level ?>"><?= $crs->title ?></a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "<p class='m-3'>No courses</p>";
                                }
                                ?>
                                <!-- End Course Item-->
                            </div>
                        </div>

                        <div class="courses ">

                            <div class="course-inner mb-2 d-flex justify-content-between">
                                <span> Courses Completed</span>
                                <span class="num-span text-success"><?= $comtd_stmt->rowCount() > 0 ? $comtd_stmt->rowCount() : 0 ?> courses</span>
                            </div>

                            <div class="row  px-4 pb-2" data-aos="zoom-in" data-aos-delay="100">
                                <?php
                                if ($comtd_stmt->rowCount() > 0) {
                                    foreach ($comtd_results as $ctd) { ?>
                                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                            <div class="course-item">
                                                <img src="assets/img/course-1.jpg" class="img-fluid" alt="..." />
                                                <div class="course-content">
                                                    <div class="
                                                d-flex
                                                justify-content-between
                                                align-items-center
                                                mb-3
                                                ">
                                                        <h4><?= $ctd->category ?></h4>
                                                    </div>

                                                    <h3>
                                                        <a href="#"><?= $ctd->title ?></a>
                                                        <!-- <a href="?module=pages&page=course_details&id=<?= $ctd->course_id ?>"><?= $ctd->title ?></a> -->
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "<p class='m-3'>No courses</p>";
                                }
                                ?>

                                <!-- End Course Item-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Section -->
</main>
<script>
    function Copy() {
        /* Get the text field */
        var copyText = document.getElementById("copy");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

    };
</script>