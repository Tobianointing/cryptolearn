<?php

$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];

//total users
$sql = "SELECT COUNT(*) AS totusers FROM users WHERE user_type=?";
$query = $pdo->prepare($sql);
$query->execute(['user']);
$result = $query->fetch();

//total courses
$sql2 = "SELECT COUNT(*) AS totcourse FROM courses";
$query2 = $pdo->prepare($sql2);
$query2->execute();
$result2 = $query2->fetch();

//total sub history
$sql3 = "SELECT COUNT(*) AS totsub FROM sub_history";
$query3 = $pdo->prepare($sql3);
$query3->execute();
$result3 = $query3->fetch();

//courses list (all courses)

$Query5 = "SELECT *
FROM courses INNER JOIN authors 
ON courses.author_id=authors.id 
ORDER BY courses.released_date DESC";
$stmt5 = $pdo->prepare($Query5);
$stmt5->execute();
$results5 = $stmt5->fetchAll();

//for sub history table (all sub history)
$Query = "SELECT subscriptions.name, 
subscriptions.amount,
subscriptions.duration,
CONCAT(users.first_name, ' ', users.last_name) as fullname,
sub_history.date,
sub_history.status
FROM sub_history
INNER JOIN users ON users.user_id=sub_history.user_id
INNER JOIN subscriptions ON subscriptions.sub_id=sub_history.sub_id
ORDER BY sub_history.date";

$stmt = $pdo->prepare($Query);
$stmt->execute();
$results4 = $stmt->fetchAll();
// var_dump($results);

?>

<style>
    #curve1 {
        height: 100%;
        width: 100%;
        font: bold 30px Arial;
        color: #1b00ff;
    }

    #curve2 {
        height: 100%;
        width: 100%;
        font: bold 30px Arial;
        color: rgb(0, 224, 145);
    }

    #curve3 {
        height: 100%;
        width: 100%;
        font: bold 30px Arial;
        color: rgb(245, 103, 103);
    }
</style>

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Dashboard</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row clearfix progress-box">
    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                <div class="p-5" id='curve1'><?= $result->totusers ?></div>
                <h5 class="text-blue padding-top-10 h5">Total Users</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                <div class="p-5" id='curve2'><?= $result2->totcourse ?></div>
                <h5 class="text-light-green padding-top-10 h5">Total Courses</h5>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                <div class="p-5" id='curve3'><?= $result3->totsub ?></div>
                <h5 class="text-light-orange padding-top-10 h5">Total Subscription</h5>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                    <input type="text" class="knob dial4" value="65" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#a683eb" data-angleOffset="180" readonly>
                <h5 class="text-light-purple padding-top-10 h5">Panding Orders</h5>
                <a class="d-block">65% Average <i class="fa text-light-purple fa-line-chart"></i></a>
            </div>
        </div>
    </div> -->
</div>
<div class="row">
    <div class="col-12 mb-30">
        <div class="min-height-200px">
            <!-- basic table  Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Subscription Histories</h4>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-plus">Date</th>
                            <th>Subscription Name</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Duration(months)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($results4 as $sh) { ?>
                            <tr>
                                <td class="table-plus"><?= $sh->date ?></td>
                                <td><?= $sh->name ?></td>
                                <td><?= $sh->fullname ?></td>
                                <td><?= $sh->amount ?></td>
                                <td><?= $sh->duration ?></td>
                                <td><?php echo $sh->status == 1 ?  "<span class='badge badge-success'>active</span>" :  "<span class='badge badge-danger'>inactive</span>"; ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 mb-30">
        <div class="min-height-200px">
            <!-- basic table  Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Courses</h4>
                    </div>
                </div>
                <table class="data-table table  hover">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Title</th>
                            <th>Desc</th>
                            <th>Authur</th>
                            <th>Level</th>
                            <th>Duration</th>
                            <th>Rating</th>
                            <th>Category</th>
                            <th>No. of Reg pple</th>
                            <th>Released Date</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($results5 as $course) { ?>
                            <tr>
                                <td class="table-plus"><?php echo $course->title ?></td>
                                <td><?php echo $course->description ?></td>
                                <td><?php echo $course->name ?></td>
                                <td><?php echo $course->level ?></td>
                                <td><?php echo $course->duration ?></td>
                                <td><?php echo $course->rating ?></td>
                                <td><?php echo $course->category ?></td>
                                <td><?php echo $course->no_of_pple_enrolled ?></td>
                                <td><?php echo $course->released_date ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="?module=manage_courses&page=edit_course&id=<?php echo $course->course_id ?>"><i class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" href="?module=manage_courses&page=edit_course&id=<?php echo $course->course_id ?>"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>