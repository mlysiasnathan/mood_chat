
<!-- Sidebar -->
<?php if ($data['title'] === 'Chat'): ?>
        <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion toggled" id="accordionSidebar">
<?php else: ?>
        <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">
<?php endif ?>

<!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people'?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= URL_ROOT ?>/public/img/logo.svg" id="logo-navbar">
                </div>
                <div class="sidebar-brand-text mx-3"><?= SITE_NAME ?></div>
            </a>

<!-- Divider -->
            <hr class="sidebar-divider my-0 bg-white">

<!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people'?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>People</span></a>
            </li>

<!-- Divider -->
            <hr class="sidebar-divider bg-white">

<!-- Heading -->
            <div class="sidebar-heading mb-2">
                
<!-- Sidebar Toggler (Sidebar) -->
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
                Chats
            </div>

            <hr class="sidebar-divider bg-white">
<!-- Nav Item - User -->            
            <li class="nav-item">
                <?php if(!empty($data['conversations'])): ?>
                    <?php foreach ($data['conversations'] as $conversation): ?>
                    
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse<?=$conversation->user_id?>" aria-expanded="true" aria-controls="collapseTwo">
                            <img class="img-profile rounded-circle" src="<?= URL_ROOT ?>/public/uploaded/<?=$conversation->img?>">
                            <span><?=$conversation->names?></span>
                        </a>
                        <div id="collapse<?=$conversation->user_id?>" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar">
                            <div class="row bg-white justify-content-center py-2 collapse-inner rounded">
                                <h6 class="collapse-header text-danger row">Last message:</h6>
                                <a href="<?= URL_ROOT ?>/chats/with/<?=$conversation->names?>">
                                    <h6 class="rounded p-2 text-xs font-weight-bold btn-danger">
                                        <?= $this->userModel->lastChat($_SESSION['user_id'], $conversation->user_id); ?>
                                    </h6>
                                </a>
                            </div>
                        </div>
                        <hr class="sidebar-divider">
                   <?php endforeach ?>
                <?php else: ?>
                    <div class="alert alert-info rounded text-center m-2" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <i class="fas fa-comments d-block fs-big"></i>
                            Start New Chat
                    </div>
                <?php endif ?>

<!--End of Nav Item - User -->
            </li>
            
        </ul>
<!-- End of Sidebar -->
