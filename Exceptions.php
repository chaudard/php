<?php
function additionner($a,$b){
	if (!is_numeric($a) || !is_numeric($b)) {
		throw new Exception("Les deux valeleurs doivent être numériques.");
	}
	$c = $a + $b;
	return $c;
}
try {
echo additionner(7,8).'</br>';
echo additionner('blabla',8).'</br>';
echo additionner(2,3).'</br>';
} catch (Exception $e) {
	echo 'Une exception a été lançée suite à l\'erreur :'.$e->getMessage();
}
echo '</br> fin du script.';
?>