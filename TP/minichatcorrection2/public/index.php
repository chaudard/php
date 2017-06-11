<?php

// Saves the pseudo in a cookie
if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
	setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
	header('location: index.php');
} else {
	setcookie('pseudo', "", NULL, -1);
}

// Inclusion of the controller
include '../app/controller/class/Message.php';

// Inclusion of classes
include '../app/model/Management.php';
include '../app/controller/message_processing.php';

// Inclusion of the template (the chat page)
include 'templates/chat.php';