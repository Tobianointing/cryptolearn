<div class="row">
    <div class="col-12">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Courses Enrolled</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Courses Enrolled</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Courses Enrolled</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Courses Enrolled</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap display">
                        <?php
                        $Query = "SELECT courses.title, 
                        CONCAT(users.first_name, ' ', users.last_name) as name,
                        courses_enrolled.date
                        FROM courses_enrolled
                        INNER JOIN users ON users.user_id=courses_enrolled.user_id
                        INNER JOIN courses ON courses.course_id=courses_enrolled.course_id
                        ORDER BY courses_enrolled.id";

                        $stmt = $pdo->prepare($Query);
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        // var_dump($results);

                        ?>
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Date</th>
                                <th>Name of Course</th>
                                <th>Name of User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($results as $r) { ?>
                                <tr>
                                    <td class="table-plus"><?= $r->date ?></td>
                                    <td><?= $r->title ?></td>
                                    <td><?= $r->name ?></td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
        </div>
    </div>
</div>