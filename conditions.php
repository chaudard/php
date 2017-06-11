<?php
$ageI = 12;
if ($ageI < 18) {
	echo 'je suis mineur';
}
else {
	echo 'je suis majeur';
}
$maCoteI = 13;
echo '<br/> ma cote est : '.$maCoteI.'<br/>';
switch ($maCoteI) {
	case 1:
		echo 'je suis nul.';
		break;
	
	case 10:
		echo 'je peux faire beaucoup mieux.';
		break;

	default:
		echo 'je n\'ai pas de commentaire pour cette cote';
		break;
}
echo '<br/>';
/*ternaire*/
$majeurB = ($ageI >= 18) ? true : false;
if ($majeurB) {
 	echo 'condition ternaire : majeur';
 } else {
 	echo 'condition ternaire : mineur';
 }
