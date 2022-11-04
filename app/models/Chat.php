<?php 

class Chat
{

	private $db;
	
	public function __construct()
	{
		$this->db = new Database;
	}

	public function getChats($id_1, $id_2){
	   
	   $this->db->query('SELECT * FROM chats WHERE (from_id = :id_1 AND to_id = :id_2) OR (to_id = :id_1 AND from_id = :id_2) ORDER BY chat_id ASC');
	   $this->db->bind(':id_1', $id_1);
	   $this->db->bind(':id_2', $id_2);
	   $this->db->bind(':id_1', $id_1);
	   $this->db->bind(':id_2', $id_2);
	   $this->db->execute();

	    if ($this->db->rowCount() > 0) {
	    	$chats = $this->db->resultSet();
	    	return $chats;
	    } else {
	    	return $chats = [];
	    }
	}

	public function getIdbyNames($names){

		$this->db->query('SELECT * FROM users WHERE names = :names');
		$this->db->bind(':names', $names);
		$this->db->execute();
		if ($this->db->rowCount() === 1) {
	    	$friendId = $this->db->single();
	    	return $friendId->user_id;
	    } else {
	    	return false;
	    }
	}

	public function getFriend($friendId){

		$this->db->query('SELECT * FROM users WHERE user_id = :friendId');
		$this->db->bind(':friendId', $friendId);
		$this->db->execute();
		if ($this->db->rowCount() === 1) {
	    	$friendData = $this->db->single();
	    	return $friendData;
	    } else {
	    	return false;
	    }
	}
	public function opened($id_1, $chats){
	    foreach ($chats as $chat) {
	    	if ($chat->opened == 0) {
	    		$opened = 1;
	    		$chat_id = $chat->chat_id;

	    		$this->db->query('UPDATE chats SET   opened = :opened WHERE from_id = :id_1 AND chat_id = :chat_id');
	    		$this->db->bind(':opened', $opened);
	    		$this->db->bind(':id_1', $id_1);
	    		$this->db->bind(':chat_id', $chat_id);
	    		$this->db->execute();
	    	}
	    }
	}

	public function InsertMessages(){
		if (isset($_POST['message']) && isset($_POST['to_id'])) :

		# get data from XHR request and store them in var
		$message = trim($_POST['message']);
		$to_id = $_POST['to_id'];

		# get the logged in user's username from the SESSION
		$from_id = $_SESSION['user_id'];

		$this->db->query('INSERT INTO chats (from_id, to_id, message) VALUES (:from_id, :to_id, :message)');
		$this->db->bind(':from_id', $from_id);
		$this->db->bind(':to_id', $to_id);
		$this->db->bind(':message', $message);
	    
	    # if the message inserted
	    if ($this->db->execute()) :
	      // check if this is the first conversation between them
			$this->db->query('SELECT * FROM conversations WHERE (user_1 = :from_id AND user_2 = :to_id) OR (user_2 = :from_id AND user_1 = :to_id)');
			$this->db->bind(':from_id', $from_id);
			$this->db->bind(':to_id', $to_id);
			$this->db->bind(':from_id', $from_id);
			$this->db->bind(':to_id', $to_id);
			$this->db->execute();

		// setting up the time Zone
			// It Depends on your location or your P.c settings
			date_default_timezone_set('Africa/Lubumbashi');

			$time = date("h:i a");

			if ($this->db->rowCount() == 0 ) :
	# insert them into conversations table 
				$this->db->query('INSERT INTO conversations(user_1, user_2) VALUES (:from_id, :to_id)');
				$this->db->bind(':from_id', $from_id);
				$this->db->bind(':to_id', $to_id);
				$this->db->execute();
			endif; ?>

			<div class="row md-4 mt-2">
                <div class="ml-auto align-content-end p-1" id="me">
                    <h6 class="text-xs font-weight-bold text-danger text-right"><?= $time ?></h6>
                    <div class="card-header py-3 d-flex flex-row bg-danger shadow" id="message-sent">
                        <p class="m-0 col text-warning" style="font-size: 14px;"><?= nl2br($message) ?></p>
                        
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
                                <a class="dropdown-item" href="#">Sent at <?= $time ?></a>
                                <a class="dropdown-item" href="#">Read at</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Reply</a>
                                <a class="dropdown-item" href="#">Delete for me</a>
                                <a class="dropdown-item" href="#">Delete for everyone</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		<?php endif;
	  endif;
	}

	public function GetNewMessage(){
		if (isset($_POST['id_2'])):

		$id_1  = $_SESSION['user_id'];
		$id_2  = $_POST['id_2'];
		$opend = 0;

		$this->db->query('SELECT * FROM chats WHERE to_id = :id_1 AND from_id = :id_2 ORDER BY chat_id ASC');
		$this->db->bind(':id_1', $id_1);
		$this->db->bind(':id_2', $id_2);
		$this->db->execute();

		if ($this->db->rowCount() > 0):
		    $chats = $this->db->resultSet();

		    # looping through the chats
		    foreach ($chats as $chat):
		    	if ($chat->opened == 0):
		    		
		    		$opened = 1;
		    		$chat_id = $chat->chat_id;

		    		$this->db->query('UPDATE chats SET opened = :opened WHERE chat_id = :chat_id');
		    		$this->db->bind(':opened', $opened);
					$this->db->bind(':chat_id', $chat_id);
		    		$this->db->execute();
		    		date_default_timezone_set('Africa/Lubumbashi'); ?>

		            <div class="row md-4 mt-2">
                        <div class="p-1 w-80" id="you">
<!-- message threats and menu receiver - Dropdown -->
                            <h6 class="text-xs font-weight-bold text-danger"><?= date("h:i a", strtotime($chat->created_at)) ?></h6>
		                    <div class="card-header py-3 d-flex flex-row shadow bg-warning" id="message-rec">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-danger"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header text-warning">Message Options</div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Received at <?= $chat->created_at ?></a>
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
                                <p class="m-0 font-weight-bold text-left col text-danger" style="font-size: 14px;"><?= nl2br($chat->message) ?></p>
                            </div>
                        </div>
                    </div>

	    	<?php endif;
		    endforeach;
		endif;
	endif;
	}
}