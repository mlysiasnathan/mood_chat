<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        $data = [
            'title' => 'Sign In',
            'username' => '',
            'email' => '',
            'birthday' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'title' => 'Sign In',
                'username' => trim($_POST['username_user']),
                'email' => trim($_POST['email_user']),
                'birthday' => trim($_POST['bd_user']),
                'password' => trim($_POST['password_user']),
                'confirmPassword' => trim($_POST['conf_password']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9 ]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username is required';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Only letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email address is required';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken.';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) <= 3){
              $data['passwordError'] = 'At least 4 characters';
            } elseif (!preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'At least one numeric value.';
            }

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match,Try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
//Redirect to the login Autentification=====================================================================================
                    $loggedInUser = $this->userModel->login($data['email'], trim($_POST['password_user']));

                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['LogInError'] = 'Password or username is incorrect. Please try again.';
                        $this->view('users' . DIRECTORY_SEPARATOR . 'register', $data);
                    }
                    
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users' . DIRECTORY_SEPARATOR . 'register', $data);
    }


    public function login() {
        $data = [
            'title' => 'Log In',
            'username' => '',
            'password' => '',
            'LogInError' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => 'Log In',
                'username' => trim($_POST['username_user']),
                'password' => trim($_POST['password_user']),
                'usernameError' => '',
                'passwordError' => '',
                'LogInError' => '',
            ];
            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username is required';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Password is required';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['LogInError'] = 'Password or username is incorrect. Please try again.';

                    $this->view('users' . DIRECTORY_SEPARATOR . 'login', $data);
                }
            }

        } else {
            $data = [
            'title' => 'Log In',
            'username' => '',
            'password' => '',
            'LogInError' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];
        }
        $this->view('users' . DIRECTORY_SEPARATOR . 'login', $data);
    }

    public function forgot(){
        $data = [
                'title' => 'Forgotten Password',
                'email' => '',
                'emailError' => '',
                'success' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];
            //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Forgotten Password',
                'email' => trim($_POST['user_email']),
                'emailError' => '',
                'selector' => '',
                'token' => '',
                'expires' => '',
                'success' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];
            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email address is required';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Enter the correct format.';
            } else {
                // //Check if email exists.
                // if ($this->userModel->findUserByEmail($data['email'])) {
                //     $data['emailError'] = 'Email is already taken.';
                // }
            }
            // Make sure that errors are empty
            if (empty($data['emailError'])){
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);
                $expires = date('U') + 3000;
                $url = URL_ROOT  . '/users/reset/?sel=' . $selector . '&val=' . bin2hex($token);
                $data['selector'] = $selector;
                $data['token'] = password_hash($token, PASSWORD_DEFAULT);
                $data['expires'] = $expires;

                if ($this->userModel->deleteToken($data)) {

                    if ($this->userModel->insertToken($data)) {
                        $to = $data['email'];
                        $subject = "Reset your password for MooD";
                        $message = nl2br("We recieved a password reset request from your email address
                                            if it is not you make sure to check your account security
                                        <p>The link below will reset you password, Click here below</p>");
                        $message .= '<br/><a href="' . $url . '">' . $url . '</a>';
                        $headers = "From MooD Admin-Support <mlysiasnathan@gmail.com>\r\n";
                        $headers .= "Reply-To: " . $data['email']. "\r\n";
                        $data['success'] = "A link to reset your password was been sent to " . $data['email'] . " Check your email's inbox";
                        mail($to, $subject, $message, $headers);
                        var_dump($url);

                    } else {
                        die('Something went wrong with insertion');
                    }

                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users' . DIRECTORY_SEPARATOR . 'forgot', $data);
    }

    public function reset(){
        $data = [
            'title' => 'Reset password',
            'password' => '',
            'confirmPassword' => '',
            'emailError' => '',
            'success' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
            'selector' => '',
            'token' => '',
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => 'Reset password',
                'email' => '',
                'emailError' => '',
                'success' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'password' => trim($_POST['new_pass']),
                'confirmPassword' => trim($_POST['conf_pass']),
                'selector' => trim($_POST['selector']),
                'token' => trim($_POST['validator']),
                'currentDate' => '',
            ];

            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
            // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) <= 3){
              $data['passwordError'] = 'At least 4 characters';
            } elseif (!preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'At least one numeric value.';
            }

            //Validate confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter the same password again.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match,Try again.';
                }
            }
            // Make sure that errors are empty
            if (empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                $currentDate = date('U');
                $data['currentDate'] = $currentDate;
                                
                if ($this->userModel->selectReset($data) !== false) {
                    // Hash token
                    $data['token'] = hex2bin($data['token']);
                    $data['token'] = password_verify($data['token'], $this->userModel->selectReset($data)->reset_token);
                    if ($data['token']) {
                        $data['email'] = $this->userModel->selectReset($data)->reset_email;
                        // Hash password
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        if($this->userModel->getOwnerReset($data['email'])){
                            $this->userModel->updatePassword($data);
                            $this->userModel->deleteToken($data);
// Autentification==================================================================================
                            $loggedInUser = $this->userModel->login($data['email'], trim($_POST['new_pass']));

                            if ($loggedInUser) {
                                $this->createUserSession($loggedInUser);
                            } else {
                                $data['LogInError'] = 'Password or username is incorrect. Please try again.';
                                $this->view('users' . DIRECTORY_SEPARATOR . 'login', $data);
                            }

                        }

                    } else {
                        die('Something went wrong re-submit your request from the begging yes');
                    }
                    

                } else {
                    die('Something went wrong re-submit your request from the begging');
                }

            }
        }

        $this->view('users' . DIRECTORY_SEPARATOR . 'forgot', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['username'] = $user->names;
        $_SESSION['email'] = $user->email;
        header('location:' . URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URL_ROOT);
    }
}
