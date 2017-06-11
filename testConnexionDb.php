<?php
try
{
// on se connecte à la db test, en local, avec les login et mot de passe = root ; Sous MAMP (Mac)
$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
//echo 'connexion ok';
}
catch (Exception $e)
{
	// si la connexion ne s'est pas bien passée , on affiche un message
        die('Erreur : ' . $e->getMessage());
}
?>
<table>
   <tr>
       <th>nom</th>
       <th>possesseur</th>
       <th>console</th>
       <th>prix</th>
       <th>nbJoueursMax</th>
       <th>commentaires</th>
   </tr>
<?php

// on demande de récupérer la totalité de la table jeux_video
//$reponse = $bdd->query('SELECT * FROM jeux_video WHERE possesseur=\'Patrick\' AND prix < 20');
//$reponse = $bdd->query('SELECT * FROM jeux_video WHERE possesseur=\'Patrick\' ORDER BY prix DESC');
$reponse = $bdd->query('SELECT nom, possesseur, console, prix, nbre_joueurs_max, commentaires FROM jeux_video WHERE console=\'Xbox\' OR console=\'PS2\' ORDER BY prix DESC LIMIT 0,10');

// on récupère les entrées une à une
while ($donnees = $reponse -> fetch()) {

?>
<!-- affichons les données en html , avec des rappels de php pour les valeurs -->

   <tr>
       <td><?php echo $donnees['nom'] ?></td>
       <td><?php echo $donnees['possesseur'] ?></td>
       <td><?php echo $donnees['console'] ?></td>
       <td><?php echo $donnees['prix'] ?></td>
       <td><?php echo $donnees['nbre_joueurs_max'] ?></td>
       <td><?php echo $donnees['commentaires'] ?></td>
   </tr>
 

<!-- ------------------------------ -->
<?php

}

// fin de la requête
$reponse->closecursor();
?>
</table>
<?php
?>