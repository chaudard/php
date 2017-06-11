<?php
// encodage d'un tableau numéroté
$enfantsA = array('Julien','Lisa','Alexia');
$parentsA[] = 'dany';
$parentsA[] = 'catalina';
// récupération des valeurs d'un tableau numéroté
echo 'le père est '.$parentsA[0].'.<br/>';
echo 'le fils est '.$enfantsA[0].'.<br/>';
// encodage d'un tableau associatif
$coordonneesA = array('rue' => 'gustave Lhoir', 'numero' => '56', 'codePostal' => '7334', 'commune' => 'Hautrage');
// récupération d'une valeur dans un tableau associatif
echo 'Ils habitent tous les deux à '.$coordonneesA['commune'].'.<br/>';
// récupération du nombre d'éléments dans le tableau
echo 'Il y a '.count($enfantsA).' enfants <br/>';
// boucle qui récupère uniquement les valeurs d'un tableau associatif
foreach ($enfantsA as $enfant) {
	echo $enfant.'<br/>';
}
echo 'Toute la famille habite : <br/>';
// boucle qui récupère la clé et la valeur des éléments d'un tableau assiciatif
foreach ($coordonneesA as $cle => $value) {
	echo $cle.' : '.$value.'<br/>';
}
echo 'display of array coordonneesA <br/>';
// debug d'un tableau
echo '<pre>';
print_r($coordonneesA);
echo '</pre>';
// recherche d'une clé dans un tableau
if (array_key_exists('rue', $coordonneesA)) {
	echo 'la clé "rue" existe dans le tableau de coordonneesA. <br/>';
}
// recherche d'une valeur dans un tableau
if (! in_array('jambon', $coordonneesA)) {
	echo 'la valeur "jambon" n\'existe pas dans le tableau $coordonneesA. <br/>';
}
// recherche de la clé qui correspond à une valeur
$value = '7334';
$cle = array_search($value, $coordonneesA);
echo 'la cle correspondante à '.$value.' est : '.$cle.'. <br/>';
?>