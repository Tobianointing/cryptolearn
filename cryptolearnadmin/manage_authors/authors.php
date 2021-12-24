<?php
if (isset($_SESSION['author'])) {
    echo $_SESSION['author'];
    unset($_SESSION['author']);
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
                            <h4>Authors</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Mange authors</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Authors</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="?module=manage_authors&page=add_author" role="button">
                            Add Author
                        </a>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Authors</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap display">
                        <?php
                        $Query = "SELECT *
                        FROM authors
                        ORDER BY name";

                        $stmt = $pdo->prepare($Query);
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        // var_dump($results);

                        ?>
                        <thead>
                            <tr>
                                <th class="table-plus">Author Name</th>
                                <th>About Author</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($results as $a) { ?>
                                <tr>
                                    <td class="table-plus"><?php echo $a->name ?></td>
                                    <td><?php echo $a->about ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="?module=manage_authors&page=edit_author&id=<?php echo $a->id ?>"><i class="dw dw-eye"></i> View</a>
                                                <a class="dropdown-item" href="?module=manage_authors&page=edit_author&id=<?php echo $a->id ?>"><i class="dw dw-edit2"></i> Edit</a>
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