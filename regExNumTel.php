<?php
$myNumTel = "0123457865";
$myRegEx = "#^0[1-68]\d{8}$#"; // pour rappel : \d = [0-9]
/*
- le premier chiffre est TOUJOURS un 0 ;
- le second chiffre va de 1 à 6 (1 pour la région parisienne… 6 pour les téléphones portables), mais il y a aussi le 8 (ce sont des numéros spéciaux). À noter que le 7 et le 9 commencent à être utilisés mais que nous ne les prendrons pas en compte dans nos exemples ;
- ensuite viennent les 8 chiffres restants (ils peuvent aller de 0 à 9 sans problème).
*/
$myNumTel = "0123 45-78.65";
$myRegEx = "#^0[1-68]([-. ]?\d{2}){4}$#";
if (preg_match($myRegEx, $myNumTel)) {
	echo $myNumTel.' est bien un numéro de téléphone français.';
} else {
	echo $myNumTel. ' n\'est pas un numéro de téléphone français';
}
?>