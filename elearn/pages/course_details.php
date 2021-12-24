<?php
require_once 'config/redirect.php';

$id = $_GET['id'];

$Query = "SELECT *
FROM courses INNER JOIN authors 
ON courses.author_id=authors.id WHERE course_id=?
ORDER BY courses.released_date DESC";

$stmt = $pdo->prepare($Query);
$stmt->execute([$id]);
$result = $stmt->fetch();
// var_dump($result);

$v_query = "SELECT * FROM videos WHERE course_id=?";
$v_stmt = $pdo->prepare($v_query);
$v_stmt->execute([$id]);
$v_results = $v_stmt->fetchAll();

if ($v_stmt->rowCount() > 0) {
    $first_video = $v_results[0]->video_link;
} else {
    $first_video = '';
}

?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Course Details</h2>
            <!-- <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p> -->
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">
            <?php
            if (isset($_SESSION['sub_expired'])) {
                echo $_SESSION['sub_expired'];
                unset($_SESSION['sub_expired']);
            } elseif (isset($_SESSION['not_subscribe'])) {
                echo $_SESSION['not_subscribe'];
                unset($_SESSION['not_subscribe']);
            } elseif (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } elseif (isset($_SESSION['pwd'])) {
                echo $_SESSION['pwd'];
                unset($_SESSION['pwd']);
            }
            ?>
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <img src="<?php if ($result->image) {
                                    echo '../cryptolearnadmin/images/courses/' . $result->image;
                                } else {
                                    echo 'assets/img/crypto_details.jpg';
                                } ?>" class="img-fluid" alt="">
                    <!-- <h3>Et enim incidunt fuga tempora</h3>
                    <p>
                        Qui et explicabo voluptatem et ab qui vero et voluptas. Sint voluptates temporibus quam autem. Atque nostrum voluptatum laudantium a doloremque enim et ut dicta. Nostrum ducimus est iure minima totam doloribus nisi ullam deserunt. Corporis aut officiis
                        sit nihil est. Labore aut sapiente aperiam. Qui voluptas qui vero ipsum ea voluptatem. Omnis et est. Voluptatem officia voluptatem adipisci et iusto provident doloremque consequatur. Quia et porro est. Et qui corrupti laudantium
                        ipsa. Eum quasi saepe aperiam qui delectus quaerat in. Vitae mollitia ipsa quam. Ipsa aut qui numquam eum iste est dolorum. Rem voluptas ut sit ut.
                    </p> -->
                </div>
                <div class="col-lg-4">

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Title</h5>
                        <p><a href="#"><?= $result->title ?></a></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Author</h5>
                        <p><a href="#"><?= $result->name ?></a></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Category</h5>
                        <p><?= $result->category ?></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Level</h5>
                        <p><?= $result->level ?></p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>People that have taken the course</h5>
                        <p><?= $result->no_of_pple_enrolled ?></p>
                    </div>

                    <div class="mt-4">
                        <a href="pages/validatesub.php?id=<?= $result->course_id ?>&level=<?= $result->level ?>" class="btn btn-lg btn-primary">
                            Start Course
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Cource Details Section -->

    <!-- ======= Cource Details Tabs Section ======= -->
    <section id="cource-details-tabs" class="cource-details-tabs">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">About the course</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">About the author</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Comment(3)</a>
                        </li> -->

                    </ul>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1">
                            <div class="row">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <h3>About the course</h3>
                                    <!-- <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p> -->
                                    <p><?= $result->description ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class="row">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <h3>About the author</h3>
                                    <h4><?= $result->name ?></h4>
                                    <!-- <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p> -->
                                    <p><?= $result->about ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-3">
                            <div class="row">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <h3>Comments</h3>
                                    <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                                    <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit
                                        ullam. Soluta et harum voluptatem optio quae</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0 course-outline">
                    <h3>Course outline</h3>
                    <?php
                    if ($v_stmt->rowCount() > 0) {
                        foreach ($v_results as $v) { ?>
                            <a href="#">
                                <div class="d-flex justify-content-between ">
                                    <div>
                                        <p class="ml-5"> <i class='bx bx-play-circle'></i> <?= $v->video_title ?></p>
                                    </div>
                                    <div>
                                        <p class="ml-5"> <i class='bx bx-time-five'></i> <?= round($v->video_duration / 60, 2) ?>m</p>
                                    </div>
                                </div>
                            </a>
                    <?php
                        }
                    } else {
                        echo 'No video';
                    }
                    ?>
                </div>

            </div>
    </section>
    <!-- End Cource Details Tabs Section -->

</main>