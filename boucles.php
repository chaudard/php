<?php
$nbrLignesI = 1;
while ($nbrLignesI <= 10) {
	echo 'php écrit la ligne '.$nbrLignesI.' de ma boucle while. <br/>';
	$nbrLignesI++;
}
for ($nbrLignesI=0; $nbrLignesI < 5; $nbrLignesI++) { 
	echo 'php écrit la ligne '.($nbrLignesI+1).' de ma boucle for. <br/>';
}