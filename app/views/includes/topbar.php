<!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn d-md-none btn-warning rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

<!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" id="searchText" placeholder="Search your friends" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-warning" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

<!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

<!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
<!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" id="searchText2" placeholder="Search your friends"
                                aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-warning" type="button" id="searchBtn2">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

<!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
<!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
<!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header" id="notif">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <?php if(isset($data['usernameError'])) : ?>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?= (new Datetime())->format('M d, Y - h:i a'); ?></div>
                                            
                                                <span class="invalidFeedback font-weight-bolder text-danger">
                                                    <?= $data['usernameError'];?>
                                                </span>
                                            
                                        </div>
                                    </a>
                                <?php endif ?>

                                <?php if(isset($data['emailError'])) : ?>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-danger">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?= (new Datetime())->format('M d, Y - h:i a'); ?></div>
                                            
                                                <span class="invalidFeedback font-weight-bolder text-danger">
                                                    <?= $data['emailError'];?>
                                                </span>
                                            
                                        </div>
                                    </a>
                                <?php endif ?>

                                <?php if(isset($data['passwordError'])) : ?>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-danger">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?= (new Datetime())->format('M d, Y - h:i a'); ?></div>
                                            
                                                <span class="invalidFeedback font-weight-bolder text-danger">
                                                    <?= $data['passwordError'];?>
                                                </span>
                                            
                                        </div>
                                    </a>
                                <?php endif ?>

                                
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

<!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
<!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter" id="notificationsMessage"><?= $this->userModel->getMesBadge(); ?></span>
                            </a>
<!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header" id="notif">
                                    Message Center
                                </h6>
                        <?php if(!empty($data['unreads'])): ?>
                            <?php foreach($data['unreads'] as $unread): ?>
                                <?php $user_id = $unread->from_id ?>
                                    <?php $unreadUsers = $this->chatModel->getFriend($user_id) ?>
                                <a class="dropdown-item d-flex align-items-center" href="<?= URL_ROOT ?>/chats/with/<?=$unreadUsers->names?>">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="<?= URL_ROOT ?>/public/uploaded/<?= $unreadUsers->img?>">
                                        <?php if ($this->userModel->last_seen($unreadUsers->last_seen) === "Just now"): ?>
                                            <div class="status-indicator bg-success"></div>
                                        <?Php endif  ?>
                                    </div>
                                    <div class="font-weight-bold">
                                        
                                        <div class="small text-gray-500"><?= $unreadUsers->names ?> · <?= $this->userModel->last_seen($unread->created_at) ?></div>
                                        <div class="text-truncate"><?= $unread->message ?></div>
                                    </div>
                                </a>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="alert alert-info rounded text-center m-2" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                <span class="sr-only">Error:</span>
                                <i class="fas fa-comments text-danger d-block fs-big"></i>
                                    No unread message
                            </div>
                        <?php endif ?>
                                
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?=$data['owner']->names?></span>
                                <img class="img-profile rounded-circle" src="<?= URL_ROOT ?>/public/uploaded/<?=$data['owner']->img?>">
                            </a>
<!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#EditProfilModal<?=$data['owner']->user_id?>">
                                    <i class="fas fa-user fa-md fa-fw mr-2 text-primary"></i>
                                    <h7 class="text-secondary">Profil</h7>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-md fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php if(!isset($_SESSION['dark-mode'])): ?>
                                <a class="dropdown-item" href="<?= URL_ROOT ?>/pages/darkmode">
                                    <i class="fas fa-sun fa-lg fa-fw mr-2 text-warning"></i>
                                    Light Mode
                                </a>
                            <?php else: ?>
                                <a class="dropdown-item" href="<?= URL_ROOT ?>/pages/darkmode">
                                    <i class="fas fa-moon fa-lg fa-fw mr-2 text-gray-dark"></i>
                                    Dark Mode
                                </a>
                            <?php endif ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-md fa-fw mr-2 text-danger"></i>
                                    <h7 class="text-danger font-weight-bolder">Logout</h7>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
<!-- End of Topbar -->