<?php
// connexion à la base de données
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8' , 'root', 'root',
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // gestion des erreurs
	} catch (Exception $e) {
		die('erreur : '.$e->getMessage()); // message d'erreur
	}
// la connexion s"est bien passée
// mettons à jour le jeu Mortal Kombat  : le prix passe à 60 et le nombre de joueurs à 4
$nom = 'Mortal Kombat XL';
$prix = 60;
$nbre_joueurs_max = 4;

$req = $bdd->prepare('UPDATE jeux_video SET prix=:prix , nbre_joueurs_max=:nbre_joueurs_max WHERE nom=:nom');
$req->execute(array(
	'nom' => $nom,
	'prix' => $prix,
	'nbre_joueurs_max' => $nbre_joueurs_max
	));
$req->closecursor(); 
echo 'la mise à jour du jeu '.$nom.' a bien été executée.';
?>