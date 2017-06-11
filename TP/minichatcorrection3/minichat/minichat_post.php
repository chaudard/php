<?php
	session_start();
	$_SESSION['pseudo'] = $_POST['pseudo'];

	//Verification saisie données
	if (isset($_POST['pseudo']) && isset($_POST['message']) && $_POST['message'] != "" && $_POST['pseudo'] != "")
	{
		// Connexion à la base de données
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', 'root');
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}

		// Insertion du message à l'aide d'une requête préparée
		$req = $bdd->prepare('INSERT INTO minichat (pseudo, message, date_message) VALUES(?, ?, ?)');
		$req->execute(array($_POST['pseudo'], $_POST['message'], date('d/m/Y G:i')));		
	}

	header('Location: minichat.php');
?>