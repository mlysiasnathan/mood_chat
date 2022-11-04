<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (names, email, bday, password) VALUES(:username, :email, :birthday, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function selectReset($data) {
        $this->db->query('SELECT * FROM forgotpwd WHERE reset_selector = :sel AND reset_expires >= :exp');

        //Bind values
        $this->db->bind(':sel', $data['selector']);
        $this->db->bind(':exp', $data['currentDate']);

        $row = $this->db->single();

        if ($row) {
            return $row;
        } else{
            return false;
        }
    }

    public function insertToken($data) {
        $this->db->query('INSERT INTO forgotpwd (reset_email, reset_selector, reset_token, reset_expires) VALUES(:email, :selector, :token, :exp)');

        //Bind values
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':selector', $data['selector']);
        $this->db->bind(':token', $data['token']);
        $this->db->bind(':exp', $data['expires']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteToken($data) {
        $this->db->query('DELETE FROM forgotpwd WHERE reset_email = :email');

        //Bind values
        $this->db->bind(':email', $data['email']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePic($user_id){
        
        $img_default_name = 'user.jpg';

        $this->db->query('UPDATE users SET img = :default_image WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':default_image', $img_default_name);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function darkMode(){
        if (isset($_SESSION['dark-mode'])) {
            unset($_SESSION['dark-mode']);
        }else{
            return $_SESSION['dark-mode'] = 1;
        }
    }

    public function updateWithImage($data) {
        $this->db->query('UPDATE users SET names = :username, email = :email, bday = :birthday, password = :password, img = :image WHERE user_id = :user_id');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':user_id', $data['user_id']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateNoImage($data) {
        $this->db->query('UPDATE users SET names = :username, email = :email, bday = :birthday, password = :password WHERE user_id = :user_id');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':user_id', $data['user_id']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePassword($data) {
        $this->db->query('UPDATE users SET password = :password WHERE email = :user_email');
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':user_email', $data['email']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMesBadge(){
        if (isset($_SESSION['user_id'])):

            $user_id = $_SESSION['user_id'];

            $this->db->query('SELECT * FROM chats WHERE to_id = :user_id AND opened = 0');
            $this->db->bind(':user_id', $user_id);
            $this->db->execute();
            if ($this->db->rowCount() > 0 && $this->db->rowCount() <= 9) {
                return $this->db->rowCount();
            }elseif($this->db->rowCount() >= 10){
                return '9+';
            }
        endif;
    }

    public function getUnreadMessage(){

        $user_id = $_SESSION['user_id'];

        $this->db->query('SELECT * FROM chats WHERE to_id = :user_id AND opened = 0 ORDER BY created_at DESC');
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return $unreads = $this->db->resultSet();
        } else {
            return $unreads = [];
        }
    }

    public function getUnreadUsers(){
        $unreads = $this->getUnreadMessage();
        // var_dump($unreads);
        foreach($unreads as $unread){
            $user_id = $unread->from_id;
            $this->db->query('SELECT * FROM users WHERE user_id = :user_id');
            $this->db->bind(':user_id', $user_id);
            $this->db->execute();
            return $unreadUsers = $this->db->resultSet();
        }
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :username OR names = :names');
        //Bind value
        $this->db->bind(':username', $username);
        $this->db->bind(':names', $username);

        $row = $this->db->single();

        if ($row) {
            $hashedPassword = $row->password;
        } else{
            return false;
        }
        
        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function getUsers(){
        $this->db->query("SELECT * FROM users");
        $result = $this->db->resultSet();
        return $result;
    }

    public function getOnlineUsers(){
        $this->db->query("SELECT * FROM users");
        $result = $this->db->resultSet();
        foreach ($result as $users => $user) {
            if (strtotime($user->last_seen) == time()){
                return $result;
            } else {
                return $result = [];
            }
        }
    }

    public function getOwner($user_id){
        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
        return $row;
    }
    public function getOwnerReset($email){
        $this->db->query("SELECT * FROM users WHERE email = :user_email");
        $this->db->bind(':user_email', $email);
        $row = $this->db->single();
        return $row;
    }

    public function getConversation($user_id){
      // Getting all the conversations for current (logged in) user
        $this->db->query("SELECT * FROM conversations WHERE user_1 = :user_id OR user_2 = :user_id ORDER BY conversation_id DESC LIMIT 6");
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();

        if($this->db->rowCount() > 0){
            $conversations = $this->db->resultSet();
      // creating empty array to store the user conversation
            $user_data = [];
            
            # looping through the conversations
            foreach($conversations as $conversation){
                # if conversations user_1 row equal to user_id
                if ($conversation->user_1 == $user_id) {
                    $this->db->query("SELECT * FROM users WHERE user_id = :user_id_2");
                    $this->db->bind(':user_id_2', $conversation->user_2);
                    $this->db->execute();
                } else {
                    $this->db->query("SELECT * FROM users WHERE user_id = :user_id_1");
                    $this->db->bind(':user_id_1', $conversation->user_1);
                    $this->db->execute();
                }

                $allConversations = $this->db->resultSet();

                # pushing the data into the array 
                array_push($user_data, $allConversations[0]);
            }

            return $user_data;
        } else {
            return $conversations = [];
        }  

    }

    public function lastChat($id_1, $id_2){
   
       $this->db->query('SELECT * FROM chats WHERE (from_id = :id_1 AND to_id = :id_2) OR (to_id = :id_1 AND from_id = :id_2) ORDER BY chat_id DESC LIMIT 1');
       $this->db->bind(':id_1', $id_1);
       $this->db->bind(':id_2', $id_2);
       $this->db->bind(':id_1', $id_1);
       $this->db->bind(':id_2', $id_2);
       $this->db->execute();

        if ($this->db->rowCount() > 0) {
            $chat = $this->db->single();
            return $chat->message;
        }else {
            return $chat = '';
        }
    }

    public function last_seen($date_time){
        // setting up the time Zone It Depends on your location or your P.c settings
        date_default_timezone_set('Africa/Lubumbashi');

       $timestamp = strtotime($date_time);  
       
       $strTime = array("second", "minute", "hour", "day", "month", "year");
       
       $length = array("60","60","24","30","12","10");

       $currentTime = time();
       if($currentTime >= $timestamp) {
            $diff = time() - $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            if ($diff < 3 && $strTime[$i] == "second") {
                return 'Just now';
            }else {
                return $diff . " " . $strTime[$i] . "(s) ago ";
            }
        }
    }

    public function UpdateLastSeen(){
        $this->db->query('UPDATE users SET last_seen = NOW() WHERE user_id = :user_id');
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
    }

    public function SearchUsers(){
    # check if the key is submitted
        if(isset($_POST['key'])):
    # creating simple search algorithm :) 
           $key = "%{$_POST['key']}%";
         
           $this->db->query('SELECT * FROM users WHERE names LIKE :keys OR names LIKE :keys');
           $this->db->bind(':keys', $key);
           $this->db->bind(':keys', $key);
           $this->db->execute();

            if($this->db->rowCount() > 0):
             $searchs = $this->db->resultSet(); ?>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-primary">Searching Result</h1>
                    <a class="p-1 rounded btn btn-outline-primary text-xs" href="#online">Skip
                        <i class="fas fa-angle-down"></i>
                    </a>
                </div>
                <div class="row">

                    <?php foreach ($searchs as $search): ?>
                        <?php if ($search->user_id == $_SESSION['user_id']) continue;?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary mb-1">
                                                    <?= $search->names ?>
                                                </div>
                                            </div>
                                                <a href="<?= URL_ROOT ?>/chats/with/<?= $search->names; ?>" class="btn btn-primary btn-circle mr-2">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <a href="#" class="btn btn-primary btn-circle" data-toggle="modal"  data-target="#ProfilModal<?= $search->user_id ?>">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach ?>
                </div>
            <?php else: ?>
                <div class="d-sm-flex align-items-center justify-content-between mb-4" id="online">
                        <h1 class="h3 mb-0 text-primary">Searching Result</h1>
                        <a class="p-1 rounded btn btn-outline-primary text-xs" href="#online">Skip
                            <i class="fas fa-angle-down"></i>
                        </a>
                </div>
                <div class="alert alert-danger text-center">
                            <i class="fa fa-user-times d-block fs-big"></i>
                   The user "<?= htmlspecialchars($_POST['key'])?>"
                   is  not found.
                </div>
            <?php endif ?>
     <?php endif;

    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);
        $this->db->execute();

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
