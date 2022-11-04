<?php require_once APP_ROOT . DIRECTORY_SEPARATOR .'views' . DIRECTORY_SEPARATOR .'includes' . DIRECTORY_SEPARATOR . 'head.php' ?>
<body class="bg-gradient-warning" id="body">
    <div class="container">
<!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" id="row">
                    <div class="card-body p-0">
<!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-register-image">
                                <img src="<?= URL_ROOT ?>/public/img/log.svg" id="logo">
                            </div>
                            <div class="col-lg-6">
                                <div class="px-5 pt-3 pb-3">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Create an Account</h1>
                                    </div>
<!-- action= "....../register" is a method locate in controller/users -->
                                    <form class="row g-3 needs-validation" action="<?= URL_ROOT; ?>/users/register" method="POST" novalidate>

                                        <div class="input-group has-validation" id="div-input">
                                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?= $data['username'] ?>" placeholder="Usernames :" name="username_user" required>
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
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?= $data['email'] ?>" placeholder="Email address :" name="email_user" required>
                                                <div class="invalid-feedback">
                                                    Please Enter your email adress.
                                                </div>
                                        </div>
                                        <?php if(isset($data['emailError'])) : ?>
                                            <span class="invalidFeedback small pl-3 text-danger">
                                                <?= $data['emailError'];?>
                                            </span>
                                        <?php endif ?>
                                        <div class="input-group has-validation mt-2" id="div-input">
                                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-calendar"></i></span>
                                            <input  type="date" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?= $data['birthday'] ?>" placeholder="Birth day :" name="bd_user" required>
                                            <div class="invalid-feedback">
                                                'Please Enter your Birthday.'
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <div class="input-group has-validation mt-2" id="div-input">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-key ShowHidePwd"></i></span>
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
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group has-validation mt-2" id="div-input">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-key"></i></span>
                                                    <input type="password" class="form-control password" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Repeate Password :" name="conf_password" required>
                                                    <div class="invalid-feedback">
                                                        Please Enter the same password.
                                                    </div>
                                                </div>
                                                <?php if(isset($data['confirmPasswordError'])) : ?>
                                                    <span class="invalidFeedback small pl-3 text-danger">
                                                        <?= $data['confirmPasswordError'];?>
                                                    </span>
                                                <?php endif ?>
                                            </div>
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input customCheck" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Show password</label>
                                            </div>
                                        </div>
                                        <button type="submit" id="btn-login" name="user_sign_in" class="btn btn-outline-danger mt-2">Sign in</button>
                                    </form>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= URL_ROOT ?>/users/login">Already have an account? Login!</a>
                                    </div>
                                    <a href="#" class="btn btn-google btn-user btn-block" id="link">
                                        <i class="fab fa-google fa-fw"></i> Register with Google
                                    </a>
                                    <a href="#" class="btn btn-facebook btn-user btn-block" id="link">
                                        <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
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