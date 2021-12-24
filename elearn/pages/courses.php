<?php
$B_Query = "SELECT *
FROM courses INNER JOIN authors 
ON courses.author_id=authors.id
WHERE courses.level=?
ORDER BY courses.released_date DESC";

$b_stmt = $pdo->prepare($B_Query);
$b_stmt->execute(['Beginner']);
$b_results = $b_stmt->fetchAll();

$In_Query = "SELECT *
FROM courses INNER JOIN authors 
ON courses.author_id=authors.id
WHERE courses.level=?
ORDER BY courses.released_date DESC";

$in_stmt = $pdo->prepare($In_Query);
$in_stmt->execute(['Intermediate']);
$in_results = $in_stmt->fetchAll();

$Ad_Query = "SELECT *
FROM courses INNER JOIN authors 
ON courses.author_id=authors.id
WHERE courses.level=?
ORDER BY courses.released_date DESC";

$ad_stmt = $pdo->prepare($Ad_Query);
$ad_stmt->execute(['Advance']);
$ad_results = $ad_stmt->fetchAll();
// var_dump($result);

?>
<main id="main">
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="container">
      <h2>Courses</h2>
      <!-- <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p> -->
    </div>
  </div><!-- End Breadcrumbs -->

  <!-- ======= Courses Section ======= -->
  <section id="courses" class="courses">
    <div class="container" data-aos="fade-up">
      <nav class="mb-4"> 
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-beginner" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
            Beginner
          </button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-intermediate" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
            Intermediate
          </button>
          <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-advance" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
            Advance
          </button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-beginner" role="tabpanel" aria-labelledby="nav-beginner-tab">
          <div class="row g-4" >
            <?php
            foreach ($b_results as $b) { ?>
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="course-item">
                  <img src="<?php if ($b->image) {
                              echo '../cryptolearnadmin/images/courses/' . $b->image;
                            } else {
                              echo 'assets/img/course-1.jpg';
                            } ?>" class="img-fluid" alt="...">
                  <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <h4><?= $b->category ?></h4>
                      <!-- <p class="price">$169</p> -->
                    </div>

                    <h3><a href="?module=pages&page=course_details&id=<?= $b->course_id ?>"><?= $b->title ?></a></h3>
                    <p><?= $b->description ?></p>
                    <div class="trainer d-flex justify-content-between align-items-center">
                      <div class="trainer-profile d-flex align-items-center">
                        <img src="<?php if ($b->author_image) {
                                    echo '../cryptolearnadmin/images/authors/' . $b->author_image;
                                  } else {
                                    echo 'assets/img/trainers/trainer-1.jpg';
                                  } ?>" class="img-fluid" alt="">
                        <span><?= $b->name ?></span>

                      </div>
                      <div class="trainer-rank d-flex align-items-center">
                        <i class="bx bx-user"></i>&nbsp;<?= $b->no_of_pple_enrolled ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php
            }
            ?>
            <!-- End Course Item-->

          </div>
        </div>
        <div class="tab-pane fade" id="nav-intermediate" role="tabpanel" aria-labelledby="nav-intermediate-tab">
          <div class="row g-4" >
            <?php
            foreach ($in_results as $in) { ?>
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="course-item">
                  <img src="<?php if ($in->image) {
                              echo '../cryptolearnadmin/images/courses/' . $in->image;
                            } else {
                              echo 'assets/img/course-1.jpg';
                            } ?>" class="img-fluid" alt="...">
                  <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <h4><?= $in->category ?></h4>
                      <!-- <p class="price">$169</p> -->
                    </div>

                    <h3><a href="?module=pages&page=course_details&id=<?= $in->course_id ?>"><?= $in->title ?></a></h3>
                    <p><?= $in->description ?></p>
                    <div class="trainer d-flex justify-content-between align-items-center">
                      <div class="trainer-profile d-flex align-items-center">
                        <img src="<?php if ($in->author_image) {
                                    echo '../cryptolearnadmin/images/authors/' . $in->author_image;
                                  } else {
                                    echo 'assets/img/trainers/trainer-1.jpg';
                                  } ?>" class="img-fluid" alt="">
                        <span><?= $in->name ?></span>

                      </div>
                      <div class="trainer-rank d-flex align-items-center">
                        <i class="bx bx-user"></i>&nbsp;<?= $in->no_of_pple_enrolled ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php
            }
            ?>
            <!-- End Course Item-->

          </div>
        </div>
        <div class="tab-pane fade" id="nav-advance" role="tabpanel" aria-labelledby="nav-advance-tab">
          <div class="row g-4" >
            <?php
            foreach ($ad_results as $ad) { ?>
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="course-item">
                  <img src="<?php if ($ad->image) {
                              echo '../cryptolearnadmin/images/courses/' . $ad->image;
                            } else {
                              echo 'assets/img/course-1.jpg';
                            } ?>" class="img-fluid" alt="...">
                  <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <h4><?= $ad->category ?></h4>
                      <!-- <p class="price">$169</p> -->
                    </div>

                    <h3><a href="?module=pages&page=course_details&id=<?= $ad->course_id ?>"><?= $ad->title ?></a></h3>
                    <p><?= $ad->description ?></p>
                    <div class="trainer d-flex justify-content-between align-items-center">
                      <div class="trainer-profile d-flex align-items-center">
                        <img src="<?php if ($ad->author_image) {
                                    echo '../cryptolearnadmin/images/authors/' . $ad->author_image;
                                  } else {
                                    echo 'assets/img/trainers/trainer-1.jpg';
                                  } ?>" class="img-fluid" alt="">
                        <span><?= $ad->name ?></span>

                      </div>
                      <div class="trainer-rank d-flex align-items-center">
                        <i class="bx bx-user"></i>&nbsp;<?= $ad->no_of_pple_enrolled ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <?php
            }
            ?>
            <!-- End Course Item-->

          </div>
        </div>
      </div>


    </div>
  </section><!-- End Courses Section -->
</main>