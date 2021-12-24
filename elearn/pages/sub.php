<?php
require_once 'config/redirect.php';

$query = "SELECT email FROM users WHERE user_id=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$USER_ID]);
$result = $stmt->fetch();

$email = $result->email;

?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Subscription</h2>
            <p> </p>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="box">
                        <h3>Beginner</h3>
                        <h4><sup>₦</sup>10000<span> / month</span></h4>
                        <ul>
                            <li>Aida dere</li>
                            <li>Nec feugiat nisl</li>
                            <li>Nulla at volutpat dola</li>
                            <li class="na">Pharetra massa</li>
                            <li class="na">Massa ultricies mi</li>
                        </ul>
                        <form action="./paystack/initialize2.php?email" method="post">
                            <div class="btn-wrap">
                                <input type="hidden" name="amount" value="10000">
                                <input type="hidden" name="email" value="<?= $email ?>">
                                <input type="hidden" name="sub_id" value="1">
                                <input type="submit" class="btn btn-buy" name="submit" value="Subcribe Now">
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                    <div class="box featured">
                        <h3>Intermediate</h3>
                        <h4><sup>₦</sup>20000<span> / month</span></h4>
                        <ul>
                            <li>Aida dere</li>
                            <li>Nec feugiat nisl</li>
                            <li>Nulla at volutpat dola</li>
                            <li>Pharetra massa</li>
                            <li class="na">Massa ultricies mi</li>
                        </ul>
                        <form action="./paystack/initialize2.php?email" method="post">
                            <div class="btn-wrap">
                                <input type="hidden" name="amount" value="20000">
                                <input type="hidden" name="email" value="<?= $email ?>">
                                <input type="hidden" name="sub_id" value="2">
                                <input type="submit" class="btn btn-buy" name="submit" value="Subcribe Now">
                            </div>
                        </form>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                    <div class="box">
                        <h3>Advance</h3>
                        <h4><sup>₦</sup>30000<span> / month</span></h4>
                        <ul>
                            <li>Aida dere</li>
                            <li>Nec feugiat nisl</li>
                            <li>Nulla at volutpat dola</li>
                            <li>Pharetra massa</li>
                            <li>Massa ultricies mi</li>
                        </ul>

                        <form action="./paystack/initialize2.php" method="post">
                            <div class="btn-wrap">
                                <input type="hidden" name="amount" value="30000">
                                <input type="hidden" name="email" value="<?= $email ?>">
                                <input type="hidden" name="sub_id" value="3">
                                <input type="submit" class="btn btn-buy" name="submit" value="Subcribe Now">
                            </div>
                        </form>

                    </div>
                </div>


            </div>

        </div>
    </section>
    <!-- End Pricing Section -->

</main>