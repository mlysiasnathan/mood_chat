<?php
class Chats extends Controller {
    public function __construct() {
        $this->chatModel = $this->model('Chat');
        $this->userModel = $this->model('User');
    }

    public function with($names = null) {
#in this side the names don't contain any space between them from the url
        if (!isLoggedIn()) {
            header('Location: ' . URL_ROOT);
        }
        if (!$names) {
            header('Location: ' . URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people');
        }
        
#rearching for a way of compare a spaced names from database
        $users = $this->userModel->getUsers();

        foreach ($users as $key => $user) {
#linking the two names without any space
            $spaceSymbol = ' ';
            $space = '';
            $friendnames = str_replace($spaceSymbol, $space, $user->names);
#compare the $names <=> replaced one
            if ($friendnames === $names) {
#then getting the id from the controller
                if($this->chatModel->getIdbyNames($user->names)){
                    $friendId = $this->chatModel->getIdbyNames($user->names);
                }
            }
        }
        if(!isset($friendId)) {
            header('Location: ' . URL_ROOT . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'people');
        }

        $owner = $this->userModel->getOwner($_SESSION['user_id']);

        $chatWith = $this->chatModel->getChats($friendId, $owner->user_id);

        $conversations = $this->userModel->getConversation($_SESSION['user_id']);

        $friendData = $this->chatModel->getFriend($friendId);

        $this->chatModel->opened($friendId, $chatWith);

        $unreads = $this->userModel->getUnreadMessage();

        $data = [
            'title' => 'Chat',
            'users' => $users,
            'owner' => $owner,
            'unreads' => $unreads,
            'friendData' => $friendData,
            'chatWith' => $chatWith,
            'conversations' => $conversations,
        ];

        $this->view('pages'. DIRECTORY_SEPARATOR .'chat', $data);
    }

    public function search() {
        $this->userModel->SearchUsers();
    }

    public function updateLastSeen() {
        $this->userModel->UpdateLastSeen();
    }

    public function getNewMessage() {
        $this->chatModel->GetNewMessage();
    }

    public function getNotifications() {
        $this->userModel->getMesBadge();
    }

    public function insert() {
        $this->chatModel->InsertMessages();
    }

}