<?php

namespace App;
/**
* @author Robin Muller
*
* class Message
* Class that represents the message to be saved to the database
*/
class Message{

	private $pseudo;
	private $message;
	private $date;

	public function __construct($pseudo, $message)
	{

		$date = \date("Y-m-d H:i:s");
		$this->setPseudo($pseudo);
		$this->setMessage($message);
	 	$this->setdate($date);
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}

	public function setPseudo($pseudo) 
	{
		if(is_string($pseudo) && strlen($pseudo) > 1 && strlen($pseudo) <= 50 && !preg_match("#[ ]#",$pseudo)){ 
				$this->pseudo = $pseudo;
		}
	}

	public function getMessage()
	{
		return $this->message;
	}

	public function setMessage($message)
	{
		if(strlen($message) > 1) {
			$this->message = $message;
		}
	}

	public function getDate()
	{
		return $this->date;
	}

	public function setDate($date)
	{
		$this->date = $date;
	}
}