<?php
if (isset($_SESSION['file'])) {
    echo $_SESSION['file'];
    unset($_SESSION['file']);
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
                            <h4>Files</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Mange files</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Files</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="?module=manage_files&page=add_file" role="button">
                            Add File
                        </a>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Files</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap display">
                        <?php
                        $Query = "SELECT courses.title, 
                        files.file_name, 
                        files.file_link, 
                        files.file_size, 
                        files.date,
                        files.id
                        FROM courses INNER JOIN files 
                        ON courses.course_id=files.course_id 
                        ORDER BY files.file_name";

                        $stmt = $pdo->prepare($Query);
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        // var_dump($results);

                        ?>
                        <thead>
                            <tr>
                                <th class="table-plus">File Title</th>
                                <th>Course</th>
                                <th>Size(mb)</th>
                                <th>Date Added</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($results as $f) { ?>
                                <tr>
                                    <td class="table-plus"><?php echo $f->file_name ?></td>
                                    <td><?php echo $f->title ?></td>
                                    <td><?php echo $f->file_size ?></td>
                                    <td><?php echo $f->date ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="?module=manage_files&page=edit_file&id=<?php echo $f->id ?>"><i class="dw dw-eye"></i> View</a>
                                                <a class="dropdown-item" href="?module=manage_files&page=edit_file&id=<?php echo $f->id ?>"><i class="dw dw-edit2"></i> Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
        </div>
    </div>
</div>