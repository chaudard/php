<?php
try
{
// on se connecte à la db test, en local, avec les login et mot de passe = root ; Sous MAMP (Mac)
$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // cette ligne pour traquer les erreurs plus facilement
//echo 'connexion ok';
}
catch (Exception $e)
{
	// si la connexion ne s'est pas bien passée , on affiche un message
        die('Erreur : ' . $e->getMessage());
}
$possesseur = 'Patrick';
$prixMax = 40;

// passage des variables avec des points d'interrogation
//$req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = ? AND prix <= ?');
//$req->execute(array($possesseur,$prixMax));

// passage des variables avec des marqueurs
$req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = :possesseur AND prix = :prixMax');
$req->execute(array('prixMax' => $prixMax,'possesseur' => $possesseur)); // ici on n'est pas obligé de mettre les variables dans l'ordre rencontré

echo '<ul>';
while ($donnees = $req->fetch()) {
	echo '<li>'.$donnees['nom'].' ( '.$donnees['prix'].' EUR)</li>';
}
	
echo '</ul>';

$req->closecursor();
?>