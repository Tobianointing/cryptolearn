<?php
$query1 = "SELECT COUNT(*) AS allusers FROM users";
$stmt1 = $pdo->prepare($query1);
$stmt1->execute();
$result1 = $stmt1->fetch();

$query2 = "SELECT COUNT(*) AS allcourses FROM courses";
$stmt2 = $pdo->prepare($query2);
$stmt2->execute();
$result2 = $stmt2->fetch();

$query3 = "SELECT COUNT(*) AS allauthors FROM authors";
$stmt3 = $pdo->prepare($query3);
$stmt3->execute();
$result3 = $stmt3->fetch();

$query4 = "SELECT * FROM courses 
INNER JOIN authors 
ON courses.author_id=authors.id 
ORDER BY no_of_pple_enrolled 
DESC LIMIT 3";

$stmt4 = $pdo->prepare($query4);
$stmt4->execute();
$result4 = $stmt4->fetchAll();

// die('<br> <br><br><br><br><br><br><br><br>'.var_dump($_GET));

?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
        <h1>Learning Today,<br>Make Money Tomorrow</h1>
        <h2>Connect with thousands of crypto traders steadily building their literacy bricks to becoming profitable.</h2>
        <?php if ($USER_ID == "") {
            echo '<a href="./auth/register.php" class="btn-get-started">Register</a>';
        }
        ?>
    </div>
</section>
<!-- End Hero -->

<main id="main">
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
        <div class="container">

            <div class="row counters">

                <div class="col-lg-4 col-4 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="<?= $result1->allusers ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Students</p>
                </div>

                <div class="col-lg-4 col-4 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="<?= $result2->allcourses ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Courses</p>
                </div>

                <div class="col-lg-4 col-4 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="<?= $result3->allauthors ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Authors</p>
                </div>

            </div>

        </div>
    </section>
    <!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Why Choose CryptoLearn?</h3>
                        <p>
                           CryptoLearn is specially built for you, proficiently made easy for you, you get to dialogue with 
                           professionals and share minds and iseas with them for free of charge.
                        </p>
                        <div class="text-center">
                            <!-- <a href="about.html" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Specially built for You</h4>
                                    <p>Join thousands of cryptolearn users today to explore this expertly curated courses</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Proficiency made easy</h4>
                                    <p>You get to learn from some of the best minds in the finance space using simplified analogies.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class="bx bx-images"></i>
                                    <h4>Dialogue with professionals</h4>
                                    <p>Our professionals are here to help answer all your financial-related questions, no matter how many they are or how silly you think they sound. Just ask.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .content-->
                </div>
            </div>

        </div>
    </section>
    <!-- End Why Us Section -->

    <!-- ======= Popular Courses Section ======= -->
    <section id="popular-courses" class="courses">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Courses</h2>
                <p>Popular Courses</p>
            </div>

            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                <?php
                foreach ($result4 as $all) { ?>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="course-item">
                            <img src="<?php if ($all->image) {
                                    echo '../cryptolearnadmin/images/courses/' . $all->image;
                                 } else {
                                     echo 'assets/img/course-1.jpg';
                                 } ?>" class="img-fluid" alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4><?= $all->category ?></h4>
                                    <!-- <p class="price">$169</p> -->
                                </div>

                                <h3><a href="?module=pages&page=course_details&id=<?= $all->course_id ?>"><?= $all->title ?></a></h3>
                                <p><?= $all->description ?></p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    <div class="trainer-profile d-flex align-items-center">
                                        <img src="<?php if ($all->author_image) {
                                            echo '../cryptolearnadmin/images/authors/' . $all->author_image;
                                            } else {
                                                echo 'assets/img/trainers/trainer-1.jpg';
                                            } ?>" class="img-fluid" alt="">
                                        <span><?= $all->name ?></span>
                                    </div>
                                    <div class="trainer-rank d-flex align-items-center">
                                        <i class="bx bx-user"></i>&nbsp;<?= $all->no_of_pple_enrolled ?> &nbsp;&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                
            </div>

        </div>
    </section>
    <!-- End Popular Courses Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="zoom-in">
            <div class="section-title">
                <h2>Testimonials</h2>
                <p>What our students have to say.</p>
            </div>

            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/tes1.webp" class="testimonial-img" alt="">
                            <h3>Saul Jaja</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i> CryptoLearn is one of the best learning platform to learn about cryptocurrency.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                    <!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/tes2.webp" class="testimonial-img" alt="">
                            <h3>Sara Adejobi</h3>
                            <h4>Designer</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>Ever since I have started learning on crypto learn I have gain a remarkable kwonledge about the crypto market.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                    <!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/tes3.webp" class="testimonial-img" alt="">
                            <h3>Mike Uche</h3>
                            <h4>Store Owner</h4>
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>I have been able to start my crypto carrer on cryptolearn whereby I have been able to gain six figures from trading. All thanks to cryptolearn.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                    <!-- End testimonial item -->


                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <!-- End Testimonials Section -->
</main>