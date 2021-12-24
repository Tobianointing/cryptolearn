<div class="row">
    <div class="col-12">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Subscription Histories</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Histories</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Subscription Histories</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Subscription Histories</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap display">
                        <?php
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
                        $results = $stmt->fetchAll();
                        // var_dump($results);

                        ?>
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
                            foreach ($results as $sh) { ?>
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
            <!-- Simple Datatable End -->
        </div>
    </div>
</div>