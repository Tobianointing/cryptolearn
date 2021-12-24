<div class="row">
    <div class="col-12">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Referral History</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Referral History</a></li>
                                <li class="breadcrumb-item active" aria-current="page">History</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Referral History</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap display">
                        <?php
                        $Query = "SELECT *
                        FROM referral_history
                        ORDER BY date";

                        $stmt = $pdo->prepare($Query);
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        // var_dump($results);

                        ?>
                        <thead>
                            <tr>
                                <th class="table-plus">Date</th>
                                <th>Referral</th>
                                <th>Referree</th>
                                <th class="datatable-nosort">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($stmt->rowCount() > 0) {
                                foreach ($results as $a) { ?>
                                    <tr>
                                        <td class="table-plus"><?php echo $a->date ?></td>
                                        <td><?php echo $a->referral ?></td>
                                        <td><?php echo $a->referree ?></td>
                                        <td><?php echo $a->amount ?></td>
                                    </tr>
                            <?php
                                }
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