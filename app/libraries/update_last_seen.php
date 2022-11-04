<?php 

$db = new Database;

if (isset($_SESSION['user_id'])):
	
	$db->query('UPDATE users SET last_seen = NOW() WHERE user_id = :user_id');
	$db->bind(':user_id', $_SESSION['user_id']);
	$db->execute();

else :
	header("Location:" . URL_ROOT);
	exit;
endif;

?>