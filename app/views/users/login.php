<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'head.php' ?>

<body class="bg-gradient-warning" id="body">
    <div class="container">
<!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5"  id="row">
                    <div class="card-body p-0">
<!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="<?= URL_ROOT ?>/public/img/register.svg" id="logo">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h6 text-gray-900 mb-2">Log in with your Username and Password</h1>
                                    </div>
                                    <?php if($data['LogInError']) : ?>
                                        <div class="alert alert-danger rounded text-center text-xs" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <?= $data['LogInError'];?>
                                        </div>
                                    <?php endif ?>
<!-- action= "....../login" is a method locate in controller/users -->
                                    <form class="row g-3 needs-validation" action="<?= URL_ROOT; ?>/users/login" method="POST" novalidate>
                                    
                                        <div class="input-group has-validation" id="div-input">
                                            <span class="input-group-text" id="inputGroupPrepend">Aa</span>
                                            <input type="text" class="form-control" value="<?= $data['username']?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Username or Email address :" name="username_user" required>
                                            <div class="invalid-feedback">
                                               Please Enter your username.
                                            </div>
                                        </div>
                                        <?php if(isset($data['usernameError'])) : ?>
                                            <span class="invalidFeedback small pl-3 text-danger">
                                                <?= $data['usernameError'];?>
                                            </span>
                                        <?php endif ?>

                                        <div class="input-group has-validation mt-2" id="div-input">
                                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-eye-slash ShowHidePwd"></i></span>
                                            <input type="password" class="form-control password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Password :" name="password_user" required>
                                            <div class="invalid-feedback">
                                                Please Compete your password.
                                            </div>
                                        </div>
                                        <?php if(isset($data['passwordError'])) : ?>
                                            <span class="invalidFeedback small pl-3 text-danger">
                                                <?= $data['passwordError'];?>
                                            </span>
                                        <?php endif ?>

                                        <div class="form-group ml-2 mt-2">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input customCheck" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Show password</label>
                                            </div>
                                        </div>
                                        <button type="submit" id="btn-login" name="user_log_in" class="btn btn-outline-dark mb-3 mt-2"> Log in</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= URL_ROOT ?>/users/forgot">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= URL_ROOT ?>/users/register">Create an Account!</a>
                                    </div>
                                    <a href="#" class="btn btn-google btn-user btn-block"  id="link">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                    <a href="#" class="btn btn-facebook btn-user btn-block"  id="link">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Bootstrap core JavaScript-->
<script src="<?= URL_ROOT ?>/public/js/input-validation.js"></script>
<script src="<?= URL_ROOT ?>/public/js/showpassword.js"></script>
</body>
</html>