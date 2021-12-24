<?php
if (isset($_SESSION['course'])) {
    echo $_SESSION['course'];
    unset($_SESSION['course']);
} elseif (isset($_SESSION['delete'])) {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
?>
<div class="row">
    <div class="col-12">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Courses</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Mange courses</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Courses</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="?module=manage_courses&page=add_course" role="button">
                            Add Course
                        </a>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Courses</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe nowrap hover display">
                        <?php

                        $Query = "SELECT *
                        FROM courses INNER JOIN authors 
                        ON courses.author_id=authors.id 
                        ORDER BY courses.released_date DESC";

                        $stmt = $pdo->prepare($Query);
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        // var_dump($results);

                        ?>
                        <thead>
                            <tr>
                                <th class="table-plus">Title</th>
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
                            foreach ($results as $course) { ?>
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
            <!-- Simple Datatable End -->
        </div>
    </div>
</div>