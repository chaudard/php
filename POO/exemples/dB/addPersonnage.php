<?php
require 'Personnage.php';
require 'PersonnagesManager.php';
// création du personnage
$perso = new Personnage(['nom' => 'dany', 'forcePerso' => 88, 'experience' => 25, 'niveau' => 18, 'degats' => 54]);
// creation du manager en lui passant la connexion à la db
try{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// cette ligne pour traquer les erreurs plus facilement
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());// si la connexion ne s'est pas bien passée , on affiche un message
}
$manager = new PersonnagesManager($bdd);
// ajout du personnage
$manager->add($perso);
echo 'le personnage '.$perso->nom().' a été ajouté';
?>