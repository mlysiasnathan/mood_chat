<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'head.php' ?>
<body id="page-top">
<!-- Page Wrapper -->
    <div id="wrapper">
<!-- Sidebar -->
<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'sidebar.php' ?>
<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column <?= $_SESSION['dark-mode'] ?? 'bg-dark'?>">
<!-- Main Content -->
            <div id="content">
<!-- Topbar -->
<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'topbar.php' ?>
<!-- Begin Page Content -->
                <div class="container-fluid">
<!-- <pre> -->
    
<?php

// print_r($data['unreadUsers']) 


?>
    
<!-- </pre> -->

<!-- Page Heading -->

<!-- search people Card Example -->
        <div id="chatList">

            
        </div>
<!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" id="online">
            <h1 class="h3 mb-0 text-success">Online Friends</h1>
            <a class="p-1 rounded btn btn-outline-success text-xs" href="#suggested">Skip
                <i class="fas fa-angle-down"></i>
            </a>
        </div>
<!-- Content Row  online friend-->
        <div class="row">
            <?php if(!empty($data['conversations'])): ?>
                <?php foreach ($data['conversations'] as $conversation): ?>
                    <?php foreach ($data['onlines'] as $online): ?>
                        <?php if ($this->userModel->last_seen($online->last_seen) === "Just now" && $conversation->user_id == $online->user_id): ?>
                            <?php if ($online->user_id == $data['owner']->user_id) continue ?>

                                <div class="col-lg-6">
                                    <div class="card mb-4 py-3 border-left-success">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">

                                                    <div class="h5 font-weight-bold text-success mb-1">
                                                        <img class="img-profile rounded-circle" src="<?= URL_ROOT ?>/public/uploaded/<?= $online->img?>" style="height: 50px;width: 50px;">
                                                        <?= $online->names ?>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn btn-outline-success btn-circle mr-2">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                                <a class="btn btn-outline-warning btn-circle mr-2"href="<?= URL_ROOT ?>/chats/with/<?= $online->names; ?>">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                
                                                <a href="#" class="btn btn-outline-danger btn-circle" data-toggle="modal"  data-target="#ProfilModal<?= $online->user_id ?>">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php else: ?>

                        <?php endif ?>
                    <?php endforeach ?>
                <?php endforeach ?>

                    <div class="col-12 alert alert-success text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                        <span class="mx-2 my-auto">Loading for others....</span>
                    </div>

            <?php else: ?>

                <div class="col-12 alert alert-info rounded text-center" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <i class="fas fa-comments d-block fs-big"></i>
                        Start New Chat
                </div>

            <?php endif ?>

        </div>
<!--End Content online Row -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" id="suggested">
            <h1 class="h3 mb-0 text-warning">Suggested Friends</h1>
            <button class="btn btn-warning text-xs rounded p-1 prevBtn"><i class="fas fa-angle-left"></i> Prev</button>
            <button class="btn btn-warning text-xs rounded p-1 nextBtn">Next <i class="fas fa-angle-right"></i></button>
            <a class="p-1 rounded btn btn-outline-warning text-xs" href="#recent">Skip
                <i class="fas fa-angle-down"></i>
            </a>
        </div>
<!-- Content Row  suggested friend-->
<!-- Suggested people Card Example -->
        <div class="caroussel">
            <?php if (isset($data['users'])): ?>
                <?php foreach ($data['users'] as $user => $row): ?>
                    <?php if ($row->user_id == $data['owner']->user_id) continue;?>

                        <div class="col mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning mb-1">
                                            <?= $row->names; ?>
                                            </div>
                                        </div>
                                        <a class="btn btn-warning btn-circle mr-2" href="<?= URL_ROOT ?>/chats/with/<?= $row->names; ?>">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#ProfilModal<?= $row->user_id ?>">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php endforeach; ?>
            <?php else: ?>

            <div class="alert col-12 alert-danger text-center">
                <i class="fa fa-user-times d-block fs-big"></i>
                No users avalaible in out System
            </div>

            <?php endif; ?>
        </div>
<!--End Content suggested Row -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" id="recent">
            <h1 class="h3 mb-0 text-secondary">Recent Chats</h1>
            <a class="p-1 rounded btn btn-outline-secondary text-xs" href="#online">Skip
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
<!-- Recent people Card Example -->
        <div class="row">
            <?php if(!empty($data['conversations'])): ?>
                <?php foreach ($data['conversations'] as $conversation): ?>

                    <div class="col-lg-4 mb-4">
                        <div class="card shadow">
<!-- Card Header - Accordion -->
                            <a href="#collapseCardExample<?=$conversation->user_id?>" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <div class="row align-items-center px-3">
                                    <img class="img-profile rounded-circle" src="<?= URL_ROOT ?>/public/uploaded/<?= $conversation->img?>" style="height: 30px;width: 30px;">
                                    <h6 class="px-2 m-0 h5 font-weight-bold text-gray-800"><?=$conversation->names?></h6>
                                </div>
                            </a>
<!-- Card Content - Collapse -->
                            <div class="collapse" id="collapseCardExample<?=$conversation->user_id?>">
                                <div class="card-body">
                                    <h6 class="m-0 font-weight-bold text-danger mb-2">Last message</h6>
                                    <a href="<?= URL_ROOT ?>/chats/with/<?=$conversation->names?>">
                                        <h6 class="rounded p-2 text-xs font-weight-bold text-warning btn-danger">
                                            <?= $this->userModel->lastChat($_SESSION['user_id'], $conversation->user_id); ?>
                                        </h6>
                                    </a>
                                    <h6 class="text-xs">click to the last message to reply</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else: ?>

                <div class="col-12 alert alert-info rounded text-center" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <i class="fas fa-comments d-block fs-big"></i>
                        Start New Chat
                </div>

            <?php endif ?>
        </div>
            </div>
<!-- End of container-fluid -->
        </div>
<!-- End of Main Content -->
<!-- Footer -->
        <footer class="sticky-footer bg-warning shadow-xl" id="footer">

            <div class="container my-auto">
                <div class="copyright text-center my-auto">
<!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link bg-light d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="text-white">Copyright &copy; MooD Official <?= (new Datetime())->format('Y'); ?></span>
                    <button class="btn btn-outline-light btn-circle ml-3" title="About us" data-toggle="modal"  data-target="#AboutUsModal">
                        <i class="fas fa-info-circle"></i>
                    </button>
                </div>
            </div>
        </footer>
<!-- End of Footer -->
        </div>
<!-- End of Content Wrapper -->

    </div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<!-- Logout Modal-->
<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'logout-modal.php';?>

<!-- Profil friend Modal-->
<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'profil-modal.php';?>

<!-- Edit my profil Modal-->
<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'edit-profil-modal.php';?>


    <script src="<?= URL_ROOT ?>/public/js/jquery.min.js"></script>
    <script src="<?= URL_ROOT ?>/public/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<!--     <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

<!-- Custom scripts for all pages-->
    <script src="<?= URL_ROOT ?>/public/js/sb-admin-2.min.js"></script>

<!-- Page level custom scripts -->

<script src="<?= URL_ROOT ?>/public/ajax/jquery3.5.1.min.js"></script>
<script>
     
    $(document).ready(function(){
      // Search
       $("#searchText").on("input", function(){
         var searchText = $(this).val();
         if(searchText == "") return;
         $.post('<?= URL_ROOT ?>/pages/search', 
                 {
                    key: searchText
                 },
               function(data, status){
                  $("#chatList").html(data);
               });
       });


       $("#searchText2").on("input", function(){
         var searchText = $(this).val();
         if(searchText == "") return;
         $.post('<?= URL_ROOT ?>/pages/search',
                 {
                    key: searchText
                 },
               function(data, status){
                  $("#chatList").html(data);
               });
       });

       // Search using the button
       $("#serachBtn").on("click", function(){
         var searchText = $("#searchText").val();
         if(searchText == "") return;
         $.post('<?= URL_ROOT ?>/pages/search', 
                 {
                    key: searchText
                 },
               function(data, status){
                  $("#chatList").html(data);
               });
       });

       $("#serachBtn2").on("click", function(){
         var searchText = $("#searchText2").val();
         if(searchText == "") return;
         $.post('<?= URL_ROOT ?>/pages/search', 
                 {
                    key: searchText
                 },
               function(data, status){
                  $("#chatList").html(data);
               });
       });
      
      // auto update last seen  for logged in user
      let lastSeenUpdate = function(){
        $.get("<?= URL_ROOT ?>/pages/updateLastSeen");
      }
      lastSeenUpdate();
      // auto update last seen  every 10 sec
      setInterval(lastSeenUpdate, 1000);

      // let getNotifications = function(){
      //   $.get("<?= URL_ROOT ?>/pages/getNotifications",
      //       function(data){
      //           $("#notificationsMessage").html(data);
      //       });
      // }
      // getNotifications();
      // setInterval(getNotifications, 1000);
      

    });
</script>

<!-- for disabling form submissions if there are invalid inputs-->
<script src="<?= URL_ROOT ?>/public/js/input-validation.js"></script>
<script src="<?= URL_ROOT ?>/public/js/mycaroussel.js"></script>

</body>

</html>