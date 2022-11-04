


<!-- Profil Modal-->
<div class="modal fade" id="EditProfilModal<?= $data['owner']->user_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header" id="modal-header">
                <h5 class="modal-title text-white font-weight-bolder"id="exampleModalLabel">Edit my profil</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <hr>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <form method="POST" action="<?= URL_ROOT; ?>/pages/deleteProfilPicture">
                            <input type="hidden" name="user_id" value="<?= $data['owner']->user_id?>">
                            <button class="btn btn-danger btn-circle mr-1" title="Delete my picture" name="delete-img"><i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <img class="img-profile img-small rounded-circle" id="profil" src="<?= URL_ROOT ?>/public/uploaded/<?=$data['owner']->img?>">
                        
                    <form class="d-inline-block needs-validation" action="<?= URL_ROOT; ?>/pages/editmyprofil" method="POST" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="user_id" value="<?= $data['owner']->user_id?>">
                        <div class="input-group has-validation mt-1" id="div-input">
                            
                            <span class="input-group-text"id="inputGroupPrepend"><i class="fa fa-pen"></i></span>
                            <input type="file" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?=$data['owner']->img?>?>" name="img_user">

                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="input-group has-validation" id="div-input">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?= $data['owner']->names ?>" placeholder="Usernames :" name="username_user" required>
                        </div>


                        <div class="input-group has-validation mt-2" id="div-input">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?= $data['owner']->email ?>" placeholder="Email address :" name="email_user" required>
                        </div>


                        <div class="input-group has-validation mt-2" id="div-input">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-calendar"></i></span>
                            <input  type="date" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?= $data['owner']->bday ?>" placeholder="Birth day :" name="bd_user" required>
                        </div>


                        <div class="input-group has-validation mt-2" id="div-input">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-key"></i></span>
                            <input type="password" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="New Password :" name="password_user" required>
                            <div class="invalid-feedback ml-2">
                                Change your password.
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                    
                </div>
                
                <div class="modal-footer bg-gray-200">
                    <div class="input-group justify-content-center">
                        <div class="col-6">
                            <button class="p-2 col-12 rounded btn btn-danger text-xs" type="submit" name="profil-btn">
                                Update profil <i class="fas fa-check"></i>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="p-2 col-12 rounded btn btn-outline-danger text-xs" data-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


