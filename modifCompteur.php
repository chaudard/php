<?php
	//$monFichier = fopen('http://home.scarlet.be/dancatfamily/compteur.num', 'r+'); // ouverture du fichier contenant mon compteur
	$monFichier = fopen('compteur.num', 'r+'); // ouverture du fichier contenant mon compteur
	$pageVues = fgets($monFichier);
	$pageVues += 1;
	fseek($monFichier, 0);
	fputs($monFichier, $pageVues);
	fclose($monFichier);  // fermeture du fichier compteur
	echo 'cette page a été vue '.$pageVues.' fois';
?>