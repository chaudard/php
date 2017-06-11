<?php
//$myEmail = "j.dupont@php.com";
//$myEmail = "the_cypher@hotmail.com";
//$myEmail = "business_consultants@free4work.info";
$myEmail = "mega-killer.le-retour@super-site.fr.st";


$myRegEx = "#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
/*
1. On a tout d'abord le pseudonyme (au minimum une lettre, mais c'est plutôt rare). Il peut y avoir des lettres minuscules (pas de majuscules), des chiffres, des points, des tirets et des underscores « _ ». => ^[a-z0-9._-]+
2. Il y a ensuite une arobase :@. => @
3. Ensuite il y a le nom de domaine. Pour ce nom, même règle que pour le pseudonyme : que des minuscules, des chiffres, des tirets, des points et des underscores. La seule différence – vous ne pouviez pas forcément deviner – c'est qu'il y a au moins deux caractères (par exemple, « a.com » n'existe pas, mais « aa.com » oui). => [a-z0-9._-]{2,}
4. Enfin, il y a l'extension (comme « .fr »). Cette extension comporte un point, suivi de deux à quatre lettres (minuscules). En effet, il y a « .es », « .de », mais aussi « .com », « .net », « .org », « .info », etc. => \.[a-z]{2,4}$
*/  
if (preg_match($myRegEx, $myEmail)) {
	echo $myEmail.' est une adresse email valide';
} else {
	echo $myEmail.' n\'est pas un email valide.';
}
?>