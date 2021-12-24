<?php
if (isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
} elseif (isset($_SESSION['image'])) {
    echo $_SESSION['image'];
    unset($_SESSION['image']);
} elseif (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}elseif (isset($_SESSION['delete'])) {
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
                            <h4>Users</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Mange users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="?module=manage_users&page=add_user" role="button">
                            Add Users
                        </a>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Users</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap display">
                        <?php
                        $Query = "SELECT * FROM users WHERE user_type=?";
                        $stmt = $pdo->prepare($Query);
                        $stmt->execute(['user']);
                        $results = $stmt->fetchAll();
                        ?>
                        <thead>
                            <tr>
                                <th class="table-plus">Name</th>
                                <th>Phone no.</th>
                                <th>Email</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($results as $user) { ?>
                                <tr>
                                    <td class="table-plus"><?= $user->first_name . ' ' . $user->last_name ?></td>
                                    <td><?= $user->phone ?></td>
                                    <td><?= $user->email ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="?module=manage_users&page=edit_user&id=<?= $user->user_id ?>"><i class="dw dw-eye"></i> View</a>
                                                <a class="dropdown-item" href="?module=manage_users&page=edit_user&id=<?= $user->user_id ?>"><i class="dw dw-edit2"></i> Edit</a>
                                            </div>
                                        </div>
                                    </td>
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