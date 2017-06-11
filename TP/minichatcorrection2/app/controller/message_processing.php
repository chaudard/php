<?php 
// Manages the requested page
if(isset($_GET['page'])) {
	if($_GET['page'] == 1 || $_GET['page'] == 0){
		$pageMin = 0;
	} else {
		$pageMin = $_GET['page'] - 1;
		$pageMin = $pageMin * 10;
	}
} else {
	$pageMin = 0;
}

// Connection to the database
$messagesManagement = new App\Management("chat", "localhost", "root", "root");

// Recording of the message
if(isset($_POST['pseudo']) && isset($_POST['message'])) {
	$message = new App\Message($_POST['pseudo'], $_POST['message']);
	if($message->getPseudo() != NULL && $message->getMessage() != NULL) {
		 $messagesManagement->saveMessage(["pseudo" => $message->getPseudo(), "message" => $message->getMessage(), "date_message" => $message->getDate()]);
		$noPseudo = 0;
	} 
	if($message->getPseudo() == NULL ){
		$noPseudo = 1;
	}
} 

// Retrieves messages
$dataMessages = $messagesManagement->getMessages($pageMin);

//Retrieve the number of messages
$pageNb = $messagesManagement->countMessages();
foreach ($pageNb as $pageNb);
