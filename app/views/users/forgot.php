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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image">
                                <img src="<?= URL_ROOT ?>/public/img/undraw_posting_photo.svg" id="logo">
                            </div>
                        <?php if(isset($_GET['sel']) && isset($_GET['val'])) : ?>
                            <?php if(ctype_xdigit($_GET['sel']) !== false && ctype_xdigit($_GET['val']) !== false) : ?>
                                <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        <p class="mb-4">
                                            We get it, stuff happens. Just enter the same password below
                                            to complete and reset your password</p>
                                    </div>
                                    <form class="row g-3 needs-validation" action="<?= URL_ROOT; ?>/users/reset" method="POST" novalidate>
                                        <input type="hidden" name="selector" value="<?= $_GET['sel'] ?>">
                                        <input type="hidden" name="validator" value="<?= $_GET['val'] ?>">
                                        <div class="input-group has-validation mt-2" id="div-input">
                                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-key"></i></span>
                                            <input type="password" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Enter new Password :" name="new_pass">
                                        </div>

                                        <div class="input-group has-validation mt-2" id="div-input">
                                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-key"></i></span>
                                            <input type="password" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Complete the same password :" name="conf_pass">
                                        </div>

                                        <button type="submit" id="btn-login" name="user_forgot_password" class="btn btn-outline-danger mt-2">Reset password</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= URL_ROOT ?>/users/register">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small"href="<?= URL_ROOT ?>/users/login">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>

                        <?php else: ?>

                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">
                                            We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    
                                    <?php if($data['passwordError']) : ?>
                                        <div class="alert alert-danger rounded text-center text-xs" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>Go to the previos web page and 
                                            <?= $data['passwordError'];?>
                                        </div>
                                    <?php endif ?>

                                    <?php if($data['confirmPasswordError']) : ?>
                                        <div class="alert alert-danger rounded text-center text-xs" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>Go to the previos web page and 
                                            <?= $data['confirmPasswordError'];?>
                                        </div>
                                    <?php endif ?>

                                    <?php if($data['emailError']) : ?>
                                        <div class="alert alert-danger rounded text-center text-xs" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <?= $data['emailError'];?>
                                        </div>
                                    <?php endif ?>

                                    <?php if($data['success']) : ?>
                                        <div class="alert alert-success rounded text-center text-xs" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <?= $data['success'];?>
                                        </div>
                                    <?php endif ?>
                                    <form class="row g-3 needs-validation" action="<?= URL_ROOT; ?>/users/forgot" method="POST" novalidate>
                                        <div class="input-group has-validation mt-2" id="div-input">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Email address :" name="user_email">
                                        </div>
                                        <?php if(isset($data['emailError'])) : ?>
                                            <span class="invalidFeedback small pl-3 text-danger">
                                                <?= $data['emailError'];?>
                                            </span>
                                        <?php endif ?>
                                        <button type="submit" id="btn-login" name="user_forgot_password" class="btn btn-outline-danger mt-2">Get reset Link</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= URL_ROOT ?>/users/register">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small"href="<?= URL_ROOT ?>/users/login">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<!-- Bootstrap core JavaScript-->
<script src="<?= URL_ROOT ?>/public/js/input-validation.js"></script>
</body>
</html>