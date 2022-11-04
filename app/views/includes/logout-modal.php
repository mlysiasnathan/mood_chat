<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header" id="modal-header">

                    <h5 class="modal-title text-white text-uppercase"id="exampleModalLabel">Log out</h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <a href="<?= URL_ROOT ?>/users/logout" class="btn btn-danger btn-circle"><i class="fas fa-check"></i></a>
                </div>
            </div>
        </div>
    </div>