<?php
if (isset($_GET['id'])) {
    $subscription_id = $_GET['id'];
    $Query = "SELECT * FROM subscriptions WHERE sub_id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$subscription_id]);
    $result = $stmt->fetch();

    $name = $result->name;
    $amount = $result->amount;
    $detail = $result->detail;
    $duration = $result->duration;
} else {

    $name = '';
    $author = '';
    $description = '';
    $duration = '';
}
?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Edit Subscription</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Subscriptions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit subscription</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-setting">
                    <form method="post">
                        <ul class="profile-edit-list row">
                            <h4 class="text-blue h5 pl-4 mb-10">Edit Subscription</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control form-control-lg" name="name" type="text" value="<?php echo $name ?>">
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input class="form-control form-control-lg" name="amount" type="number" value="<?php echo $amount ?>">
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <input class="form-control form-control-lg" name="details" type="text" value="<?php echo $detail ?>">
                                </div>
                                <div class="form-group">
                                    <label>Duration(months)</label>
                                    <input class="form-control form-control-lg" name="duration" type="number" value="<?php echo $duration ?>">
                                </div>
                                
                                <input type="hidden" name="id" value="<?php echo $subscription_id ?>">

                                <div class="form-group mb-0">
                                    <input name="submit" type="submit" class="btn btn-primary" value="Update Subscription">
                                    <input name="delete" type="submit" class="btn btn-danger float-right" value="Delete Subscription">
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $duration = $_POST['duration'];
    $detail = $_POST['details'];

    $Query2 = "UPDATE subscriptions SET name=?, amount=?, duration=?, detail=? WHERE sub_id=?";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute([$name, $amount, $duration, $detail, $id]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['subscription'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Subcription updated successfully,
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_subscriptions&page=subscriptions');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $Query3 = "DELETE FROM subscriptions WHERE sub_id=?";
    $stmt3 = $pdo->prepare($Query3);
    $status2 = $stmt3->execute([$id]);

    if ($status2) {
        $_SESSION['delete'] = '
            <div class="m-2 alert alert-danger alert-dismissible fade show" role="alert">
                Subcription deleted.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_subscriptions&page=subscriptions');
    }
}
?>