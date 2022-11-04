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
<!-- <pre>
 -->    
<?php

// print_r($data['owner']) 

?>
    
<!-- </pre>
 -->
<!-- Page Heading -->
 <!-- search people Card Example -->
    <div class="" id="chatList">

                            
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-2"></div>
        <div class="col" id="online">
<!-- Dropdown Card Example -->
            <div class="card shadow" style="border-radius: 15px;height: 80vh;" id="chatCard">
<!-- Card Header - Dropdown -->
                <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between" id="modal-header" style="border-radius: 15px 15px 0px 0px;">
                    <div class="d-flex flex-row align-items-center">
                        <a href="<?= URL_ROOT ?>/pages/people" class="btn bg-transparent btn-circle"><i class="fas text-light fa-angle-left"></i></a>
                        <a class="nav-link collapsed" href="#"  data-toggle="modal"  data-target="#ProfilModal<?=$data['friendData']->user_id?>">
                            <img class="img-profile rounded-circle" src="<?= URL_ROOT ?>/public/uploaded/<?= $data['friendData']->img?>" style="height: 50px;width: 50px;">
                            <span class="h5 font-weight-bolder text-white text-left"><?=$data['friendData']->names?></span>

                            <?php if ($this->userModel->last_seen($data['friendData']->last_seen) === "Just now"): ?>
                                <span class="ml-3 p-1 rounded text-white text-xs bg-success">Online</span>
                            <?Php else:  ?>
                                <span class="ml-1 p-1 rounded text-danger text-xs bg-warning"><?= $this->userModel->last_seen($data['friendData']->last_seen)?></span>
                            <?php endif ?>

                        </a>
                    </div>
                </div>
<!-- Card Body -->
                <div class="card-body chat-box <?= $_SESSION['dark-mode'] ?? 'bg-gray-600'?>" id="chatBox" style="overflow-y: auto;max-height: 60vh;overflow-x: hidden;">
                    <a class="p-2 col-12 rounded btn btn-outline-danger text-xs" href="#last-message">
                        Unread Messages
                        <i class="fas fa-angle-down"></i>
                    </a>
            <?php if (!empty($data['chatWith'])): ?>
                <?php foreach ($data['chatWith'] as $chat): ?>
                    <?php if ($chat->from_id == $data['owner']->user_id): ?>
                        <div class="row md-4 mt-2">
                            <div class="ml-auto align-content-end p-1" id="me">
                                <h6 class="text-xs font-weight-bold text-danger text-right"><?= $this->userModel->last_seen($chat->created_at) ?>
                                <?php if ($chat->opened == 0): ?>
                                    <i class="fas fa-check fa-md fa-fw text-warning"></i>
                                <?php elseif ($chat->opened == 1): ?>
                                    <i class="fas fa-check fa-md fa-fw text-danger"></i>
                                    <i class="fas fa-check fa-md fa-fw text-danger"></i>
                                <?php endif ?>
                                </h6>
                                <div class="card-header py-3 d-flex flex-row bg-danger" id="message-sent">
                                    <p class="m-0 col text-warning font-weight-bolder" style="font-size: 14px;"><?= nl2br($chat->message) ?></p>
                                    
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle m-2" href="#" role="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-reply text-warning"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in p-1" aria-labelledby="dropdownMenu">
                                            <div class="dropdown-header text-warning">Replied from</div>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item bg-warning" href="#you" id="message-rec">
                                                <h6 class="pt-2 text-xs text-danger">Do you Want to say Hi !</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-warning"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header text-danger">Message Options</div>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Sent at : <span class="text-warning font-weight-bolder"><?= $chat->created_at ?></span> <i class="fas fa-check fa-md fa-fw text-warning"></i></a>
                                            <a class="dropdown-item" href="#">Read : 
                                            <?php if ($chat->opened == 0): ?>
                                                <span class="text-warning">Not Yet</span>
                                            <?php elseif ($chat->opened == 1): ?>
                                                <span class="text-danger">Yes</span>
                                                <i class="fas fa-check fa-md fa-fw text-danger"></i>
                                                <i class="fas fa-check fa-md fa-fw text-danger"></i>
                                            <?php endif ?></a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Reply</a>
                                            <a class="dropdown-item" href="#">Delete for me</a>
                                            <a class="dropdown-item" href="#">Delete for everyone</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>

                        <div class="row md-4 mt-2">
                            <div class="p-1 w-80" id="you">
<!-- message threats and menu receiver - Dropdown -->
                                <h6 class="text-xs font-weight-bold text-danger"><?= $this->userModel->last_seen($chat->created_at) ?></h6>
                                <div class="card-header py-3 d-flex flex-row bg-warning" id="message-rec">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-danger"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header text-warning">Message Options</div>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Received at : <span class="text-warning font-weight-bolder"><?= $chat->created_at ?></span></a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Reply</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </div>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle m-2" href="#" role="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-share text-danger"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in p-1" aria-labelledby="dropdownMenu">
                                            <div class="dropdown-header text-danger">Replied from</div>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item bg-danger" href="#me" id="message-sent">
                                                <h6 class="pt-2 text-xs text-warning">Type the first message !</h6>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="m-0 font-weight-bolder text-left col text-danger" style="font-size: 14px;"><?= nl2br($chat->message) ?></p>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>

                <div class="alert alert-info rounded text-center mt-4" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <i class="fas fa-comments d-block fs-big"></i>
                            Start New Chat
                </div>

            <?php endif ?>

                <div id="last-message"></div>
            </div>
            <div class="modal-footer bg-gray-400" style="border-radius: 0px 0px 15px 15px;">
<!-- message text area -->
                <!-- <form class="d-none w-100 d-inline-block form-inline needs-validation" method="POST" novalidate> -->
                    <div class="input-group">
<!--if msg was been replied message text area -->
                        <div class="input-group-append">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle btn btn-outline-danger" href="#" role="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"style="border-radius: 7px 0px 0px 7px;">
                                    <i class="fa fa-reply"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in p-1" aria-labelledby="dropdownMenu">
                                    <div class="dropdown-header text-danger">Replied from</div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item bg-danger" href="#me" id="message-sent">
                                        <h6 class="pt-2 text-xs text-warning">Type the first message !</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
<!-- Text area for typing msg -->
                        <textarea class="form-control has-invalid text-danger bg-light border-0  small" id="validationTextarea" placeholder="Type your message" style="height: 38px;" required></textarea>
<!-- for emoji -->
                        <!-- <p class="emoji-picker-container">
                            <textarea class="form-control has-invalid text-danger bg-light border-0  small" data-emojiable="true" data-emoji-input="unicode" id="validationTextarea" placeholder="Type your message" style="height: 38px;" required></textarea>
                        </p> -->
                        <button class="btn btn-danger btn-circle ml-2" type="submit" id="sendBtn">
                                <i class="fab fa-telegram-plane"></i>
                        </button>
                    </div>
                <!-- </form> -->
            </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>
            </div>
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
                <button class="btn btn-outline-light btn-circle ml-3" title="About us" data-toggle="modal"  data-target="#ProfilModal">
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
     var scrollDown = function(){
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    scrollDown();
    $(document).ready(function(){
      // Search
       $("#searchText").on("input", function(){
         var searchText = $(this).val();
         if(searchText == "") return;
         $.post('<?= URL_ROOT ?>/chats/search', 
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
         $.post('<?= URL_ROOT ?>/chats/search',
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
         $.post('<?= URL_ROOT ?>/chats/search', 
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
         $.post('<?= URL_ROOT ?>/chats/search', 
                 {
                    key: searchText
                 },
               function(data, status){
                  $("#chatList").html(data);
               });
       });

       $(document).ready(function(){
            $("#sendBtn").on('click', function(){
                message = $("#validationTextarea").val();
                
                if (message == "") return;

                $.post("<?= URL_ROOT ?>/chats/insert",
                {
                    message: message,
                    to_id: <?= $data['friendData']->user_id ?>
                },
                function(data, status){
                    $("#validationTextarea").val("");
                    $("#chatBox").append(data);
                    scrollDown();
                });
            });
       });

      // auto update last seen for logged in user
      let lastSeenUpdate = function(){
        $.get("<?= URL_ROOT ?>/chats/updateLastSeen");
      }
      lastSeenUpdate();
      // auto update last seen every 10 sec
      setInterval(lastSeenUpdate, 1000);

      let fechData = function(){
        $.post("<?= URL_ROOT ?>/chats/getNewMessage",
                {
                    id_2: <?=$data['friendData']->user_id?>
                },
                function(data, status){
                    $("#chatBox").append(data);
                    if (data != "") scrollDown();
                });
      }
      fechData();
      setInterval(fechData, 1000);

      // option 1

      // let getNotifications = function(){
      //   $.get("<?= URL_ROOT ?>/chats/getNotifications",
      //       function(data, status){
      //           $("#notificationsMessage").append(data);
      //       });
      // }
      // getNotifications();
      // setInterval(getNotifications, 1000);

      // option 2

      // let getNotifications = function(){
      //   $.post("<?= URL_ROOT ?>/chats/getNotifications",
      //           {
      //               user_id: <?= $_SESSION['user_id'] ?>
      //           },
      //           function(data, status){
      //               $("#notificationsMessage").html(data);
      //           });
      // }
      // getNotifications();
      // setInterval(getNotifications, 1000);


      


    });


// for emoji
    // $(function () {
    //     // Initializes and creates emoji set from sprite sheet
    //     window.emojiPicker = new EmojiPicker({
    //         emojiable_selector: '[data-emojiable=true]',
    //         assetsPath: 'vendor/emoji-picker/lib/img/',
    //         popupButtonClasses: 'fas fa-laugh-wink'
    //     });

    //     window.emojiPicker.discover();
    // });


</script>

<!-- for disabling form submissions if there are invalid inputs-->
<script src="<?= URL_ROOT ?>/public/js/input-validation.js"></script>

</body>

</html>