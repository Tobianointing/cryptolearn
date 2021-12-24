<?php
if (isset($_SESSION['sub'])) {
    echo $_SESSION['sub'];
    unset($_SESSION['sub']);
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
                            <h4>Subscriptions</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Mange subscriptions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a class="btn btn-primary" href="?module=manage_subscriptions&page=add_subscription" role="button">
                            Add Subscription
                        </a>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Subscriptions</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap display">
                        <?php
                        $Query = "SELECT * FROM subscriptions";
                        $stmt = $pdo->prepare($Query);
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        // var_dump($results);

                        ?>
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Name</th>
                                <th>Amount</th>
                                <th>Details</th>
                                <th>Duration(months)</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($results as $sub){ ?>
                                    <tr>
                                <td class="table-plus"><?php echo $sub->name ?></td>
                                <td><?php echo $sub->amount ?></td>
                                <td><?php echo $sub->detail ?></td>
                                <td><?php echo $sub->duration ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="?module=manage_subscriptions&page=edit_subscription&id=<?php echo $sub->sub_id ?>"><i class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" href="?module=manage_subscriptions&page=edit_subscription&id=<?php echo $sub->sub_id ?>"><i class="dw dw-edit2"></i> Edit</a>
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
