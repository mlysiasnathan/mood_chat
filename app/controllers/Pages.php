<?php
class Pages extends Controller {
    // private $db;
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->chatModel = $this->model('Chat');
        // $this->db = new Database;
    }
    
    public function people() {
        if (!isLoggedIn()) {
            header('Location: ' . URL_ROOT);
        }
        $users = $this->userModel->getUsers();
        $onlines = $this->userModel->getOnlineUsers();
        $owner = $this->userModel->getOwner($_SESSION['user_id']);
        $conversations = $this->userModel->getConversation($_SESSION['user_id']);
        $unreads = $this->userModel->getUnreadMessage();
        $unreadUsers = $this->userModel->getUnreadUsers();
        
        $data = [
            'title' => 'People',
            'users' => $users,
            'onlines' => $onlines,
            'owner' => $owner,
            'unreads' => $unreads,
            'conversations' => $conversations,
        ];
        $this->view('pages'. DIRECTORY_SEPARATOR .'index', $data);
    }

    public function search() {
        $this->userModel->SearchUsers();
    }

    public function darkmode() {
        $this->userModel->darkMode();
        header('location:' . URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people');
    }

    public function updateLastSeen() {
        $this->userModel->UpdateLastSeen();
    }

    public function getNotifications() {
        $this->userModel->getMesBadge();
    }
    public function deleteProfilPicture() {
        if (isset($_POST['delete-img'])) {
            $this->userModel->deletePic($_SESSION['user_id']);
            header('location:' . URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people');
        }
    }

    public function editmyprofil(){
        $data = [
            'title' => 'People',
            'user_id' => '',
            'username' => '',
            'email' => '',
            'birthday' => '',
            'password' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'image' => '',
            'imageTmp' => '',
            'imageError' => ''
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

// Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $users = $this->userModel->getUsers();
        $onlines = $this->userModel->getOnlineUsers();
        $owner = $this->userModel->getOwner($_SESSION['user_id']);
        $conversations = $this->userModel->getConversation($_SESSION['user_id']);
        $unreads = $this->userModel->getUnreadMessage();
        $unreadUsers = $this->userModel->getUnreadUsers();
        $data = [
            'title' => 'People',
            'user_id' => $_POST['user_id'],
            'username' => trim($_POST['username_user']),
            'email' => trim($_POST['email_user']),
            'birthday' => $_POST['bd_user'],
            'password' => trim($_POST['password_user']),
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'image' => $_FILES["img_user"]['name'],
            'imageTmp' => $_FILES["img_user"]['tmp_name'],
            'imageError' => $_FILES["img_user"]['error'],

            'users' => $users,
            'onlines' => $onlines,
            'owner' => $owner,
            'unreads' => $unreads,
            'unreadUsers' => $unreadUsers,
            'conversations' => $conversations,
        ];

            $nameValidation = "/^[a-zA-Z0-9 ]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

//Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Username is required';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Only letters and numbers and space.';
            }

//Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email address is required';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Enter the correct format.';
            } else {
//Check if email exists.
                // if ($this->userModel->findUserByEmail($data['email'])) {
                //     $data['emailError'] = 'Email is already taken.';
                // }
            }

// Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) <= 3){
              $data['passwordError'] = 'At least 4 characters';
            } elseif (!preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'At least one numeric value.';
            }

// Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                $user_id = $data['user_id'];
                $new_name = $data['username'];
                $new_email = $data['email'];
                $new_bday = $data['birthday'];
                $new_password = $data['password'];

# Profile Picture Uploading
                if (isset($data['image'])) {
                    # get data and store them in var
                    $img_name  = $data['image'];
                    $tmp_name  = $data['imageTmp'];
                    $imageError  = $data['imageError'];

# if there is not error occurred while uploading
                    if($imageError === 0){
                       
# get image extension store it in var
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

// convert the image extension into lower case and store it in var 
                        $img_ex_lc = strtolower($img_ex);

// crating array that stores allowed to upload image extension.
                        $allowed_exs = array("jpg", "jpeg", "png");

// check if the the image extension  is present in $allowed_exs array
                        if (in_array($img_ex_lc, $allowed_exs)) {

// renaming the image with user's username like: username.$img_ex_lc
                            $new_img_name = $new_name. '.'.$img_ex_lc;
                            $data['image'] = $new_img_name;

# crating upload path on root directory
                            $img_upload_path = dirname(dirname(__DIR__)) . '/public/uploaded/' .$new_img_name;

# move uploaded image to ./upload folder
                            move_uploaded_file($tmp_name, $img_upload_path);
                            echo "<script>alert('done')</script>";
                        }else {
                            echo "<script>alert('imageError ')</script>";
                            $data['imageError'] = "Can't upload this type of file";
                            echo $data['imageError'];
                            exit;
                        }

                    }
                }

# if the user upload Profile Picture
                if (isset($new_img_name)) {

# updating data into database
                    $this->userModel->updateWithImage($data);
                    echo "<script>alert('imageError with')</script>";
                    header('location:' . URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people');
                }else {

# updating data into database
                    $this->userModel->updateNoImage($data);
                    echo "<script>alert('imageError')</script>";
                    header('location:' . URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people');
                }
            }
        }
        $this->view('pages' . DIRECTORY_SEPARATOR . 'index', $data);
    }
}
?>