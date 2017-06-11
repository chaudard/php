<?php
	//if (preg_match("#Guitare#i", "j'aime jouer de la guitare.")) { vérifie si le mot guitare est dans la phrase ; le i est une option qui permet de ne plus être case sensitive
	if (preg_match("#guitare|piano#", "j'aime jouer de la piano.")) { // la barre verticale (alt+maj+L) est l'équivalent du "ou"
		echo 'le mot est dans la phrase.';
	} else {
		echo 'le mot n\'est pas dans la phrase';
	}
?>