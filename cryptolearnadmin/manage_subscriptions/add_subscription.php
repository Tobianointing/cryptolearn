<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Add Subscription</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Manage Subscriptions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add subscription</li>
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
                        <h4 class="text-blue h5 pl-4 mb-10">Add Subscription</h4>
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control form-control-lg" name="name" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input class="form-control form-control-lg" name="amount" type="number" value="">
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <input class="form-control form-control-lg" name="details" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>Duration(months)</label>
                                    <input class="form-control form-control-lg" name="duration" type="number" value="">
                                </div>
                                
                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Add Subscription">
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
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $duration = $_POST['duration'];
    $detail = $_POST['details'];

    $Query2 = "INSERT INTO subscriptions (name, amount, duration, detail) VALUES (?,?,?,?)";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute([$name,$amount,$duration,$detail]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['sub'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Subscription added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        ';
        header('location: ?module=manage_subscriptions&page=subscriptions');
    }
}
?>