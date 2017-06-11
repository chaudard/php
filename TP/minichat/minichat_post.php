<?php
// vérifions que les données ont été envoyées
if (isset($_POST['pseudo']) && isset($_POST['commentaire'])){
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$commentaire = htmlspecialchars($_POST['commentaire']);
	// vérifions que les données ne sont pas vides
	if ((!empty($pseudo))&&(!empty($commentaire))){
		// nous pouvons ajouter ce chat dans la db
		// connexion à la db
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',
							array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (Exception $e) {
			die('Error : '.$e->getMessage());
		}
		// insertion du chat
		$req = $bdd->prepare('INSERT INTO minichat (pseudo, commentaire, dateCreation) 
								VALUES (:pseudo, :commentaire, now())');
		$req->execute(array(
			'pseudo' => $pseudo,
			'commentaire' => $commentaire
			));
		$req->closecursor();
		// rétention des infos du pseudo dans un cookie
		// ce cookie n'aura une durée de vie de 15 minutes
		setcookie('pseudoMinichat', $pseudo, time() + 15*60, null, null, false, true);
		// le dernier true est pour le httpOnly
	}
} 
header('Location: minichat.php'); // renvoie vers la page minichat
?>