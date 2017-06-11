<?php

namespace App;

use \PDO;

/**
* Class Database
*
* @author Robin Muller
*
* Allows connection to the database
* Allows connection to the database
* Saves and retrieves messages in database
*/
class Management{

	private $pdo;
	private $db_name;
	private $db_host;
	private $db_user;
	private $db_pass;
	
	/**
	* connection information to the database manufacturer
	*
	* @param string $db_name represents the name of the database
	* @param string $db_host represents the server of the database
	* @param string $db_user represents the access identifier to the database
	* @param string $db_pass represents the access password on the database
	*/
	public function __construct($dbName, $dbHost, $dbUser, $dbPass)
	{
		$this->db_name = $dbName;
		$this->db_host = $dbHost;
		$this->db_user = $dbUser;
		$this->db_pass = $dbPass;
	}

	/**
	* Creation of the PDO object
	*/
	private function getPDO()
	{
		if($this->pdo === NULL)
		{

			$pdo = new PDO ("mysql:dbname=" . $this->db_name . "; host=" . $this->db_host, $this->db_user, $this->db_pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}

		return $this->pdo;
	}

	/**
	* Returns the messages as a table
	* 
	* @param int pageMin Represents the requested page
	* Returns the messages as a array
	*/
	public function getMessages($pageMin = null)
	{
		$dataMessages = $this->getPDO()->query('SELECT * FROM mini_chat ORDER BY id DESC LIMIT ' . $pageMin . ', 10');
		return $dataMessages;
	}
	
	/**
	* Return the number of messages
	*/
	public function countMessages()
	{
		$req = $this->getPDO()->query('SELECT COUNT(*) as nbPage FROM mini_chat');
		$nbMessages = $req->fetch();
		return $nbMessages;

	}
	
	/**
	* Save message to database
	*/
	public function saveMessage(array $tabArguments = NULL)
	{
		$request = $this->getPDO()->prepare('INSERT INTO mini_chat(pseudo, message, date_message) VALUES(:pseudo, :message, :date_message)');
		$request->execute($tabArguments);
	}
}