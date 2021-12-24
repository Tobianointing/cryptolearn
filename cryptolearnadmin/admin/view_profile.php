<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Profile</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">view profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box">
                <div class="profile-photo">
                    <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                    <img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body pd-5">
                                    <div class="img-container">
                                        <img id="image" src="vendors/images/photo2.jpg" alt="Picture">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="text-center h5 mb-0">Celeb Imole</h5>
            </div>

        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-setting">
                    <form>
                        <ul class="profile-edit-list row">
                            <li class="weight-500 col-md-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control form-control-lg" type="text" value="Joe Amadi" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Phone number</label>
                                    <input class="form-control form-control-lg" type="text" value="08055774488" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control form-control-lg" type="email" value="joemd@gmail.com" readonly> 
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <div class="d-flex">
                                    <div class="custom-control custom-radio mb-5 mr-20">
                                        <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input" checked readonly>
                                        <label class="custom-control-label weight-400" for="customRadio4">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input" readonly>
                                        <label class="custom-control-label weight-400" for="customRadio5">Female</label>
                                    </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>