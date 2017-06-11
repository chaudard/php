<?php
// on se connecte à la db test, en local, avec les login et mot de passe = root ; Sous MAMP (Mac)
try{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// cette ligne pour traquer les erreurs plus facilement
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());// si la connexion ne s'est pas bien passée , on affiche un message
}
// ici, la connexion s'est bien passée

// préparation des données locales à insérer
$nom = 'Mortal Kombat XL';
$possesseur = 'dany';
$console = 'PS4';
$prix = 24;
$nbre_joueurs_max = 2;
$commentaires = 'Jeu qui déchire !';

$req = $bdd->prepare('INSERT INTO jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires)
					 VALUES (:nom, :possesseur, :console, :prix, :nbre_joueurs_max, :commentaires)');
$req->execute(array(
	'nom' => $nom,
	'possesseur' => $possesseur,
	'console' => $console,
	'prix' => $prix,
	'nbre_joueurs_max' => $nbre_joueurs_max,
	'commentaires' => $commentaires
	));
$req->closecursor();
echo 'le jeu '.$nom.' a bien été ajouté.';
?>