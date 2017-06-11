<?php
// connexion à la base de données
try{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // gestion des erreurs
} catch (Exception $e) {
	die('Erreur : '.$e->getMessage()); // message d'erreur
}
// la connexion s'est bien passée
// supprimons le jeu dont le nom est :
$nom = 'Mortal Kombat XL';

$req = $bdd->prepare('DELETE FROM jeux_video WHERE nom=:nom');
$req->execute(array(
	'nom' => $nom
	));
$req->closecursor();
echo 'le jeu '.$nom.' a bien été supprimé.';
?>