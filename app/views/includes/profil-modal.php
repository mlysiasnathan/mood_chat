<?php if (isset($data['users'])): ?>
    <?php foreach ($data['users'] as $user => $row): ?>
        <?php if ($row->user_id == $data['owner']->user_id) continue;?>
            <div class="modal fade" id="ProfilModal<?= $row->user_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content" style="border-radius: 15px;">
                        <div class="modal-header" id="modal-header">

                            <h5 class="modal-title text-white font-weight-bolder"id="exampleModalLabel">Profil of <?= $row->names ?></h5>
                            <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <img class="img-profile img-small rounded-circle mb-2" id="profil" src="<?= URL_ROOT ?>/public/uploaded/<?= $row->img; ?>"></br>

                                    <?php if ($this->userModel->last_seen($row->last_seen) === "Just now"): ?>
                                        <span class="ml-5 p-1 rounded text-white text-xs bg-success">Online</span>
                                    <?Php else:  ?>
                                        <span class="ml-2 p-1 rounded text-danger text-xs bg-warning">Last seen : <?=$this->userModel->last_seen($row->last_seen)?></span>
                                    <?php endif ?>

                                </div>
                                <div class="col-lg-6">

                                    <div class="input-group has-validation" id="div-input">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
                                        <h4 class="form-control" id="validationCustomUsername"><?= $row->names ?></h4>
                                    </div>


                                    <div class="input-group has-validation mt-2" id="div-input">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <h4 class="form-control" id="validationCustomUsername"><?= $row->email ?></h4>
                                    </div>


                                    <div class="input-group has-validation mt-2" id="div-input">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-calendar"></i></span>
                                        <h4 class="form-control" id="validationCustomUsername"><?= $row->bday ?></h4>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="modal-footer bg-gray-200">
                            <form class="d-none w-100 d-inline-block form-inline">
                                <div class="input-group">
                                    <input type="textarea" class="form-control text-dark bg-light border-0 small" placeholder="Type here ......"
                                        aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-dark" type="submit" style="border-radius: 0px 7px 7px 0px;">Comment</button>
                                    </div>

                                    <a  class="btn btn-warning btn-circle mr-2 ml-2" href="<?= URL_ROOT ?>/chats/with/<?= $row->names; ?>">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button class="btn btn-danger btn-circle" data-dismiss="modal"><i class="fas fa-check"></i>
                                    </button>
                                </div>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
<?php endif; ?>
