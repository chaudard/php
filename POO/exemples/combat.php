<?php

function chargerClasse($classe){
	require $classe.'.php';
}
spl_autoload_register('chargerClasse');

//$perso1 = new Personnage;
//$perso1->setForce(110);
//$perso1->afficherForce();


//$perso1->gagnerExperience(1);
//echo 'experience perso 1 = '.$perso1->afficherExperience().'<br/>';
//$perso2 = new Personnage;
//echo 'avant de frapper<br/>';
//echo 'dégâts perso2 = '.$perso2->afficherDegats().'<br/>';
//$perso1->frapper($perso2);
//echo 'après frapper<br/>';
//echo 'dégâts perso2 = '.$perso2->afficherDegats().'<br/>';

//combat

/* sans constructeur
$perso1 = new Personnage;
$perso2 = new Personnage;

// donnons-leur leurs propres caractéristiques 
$perso1->setForce(17);
$perso1->setExperience(53);

$perso2->setForce(36);
$perso2->setExperience(76);
*/

// avec constructeur
$perso1 = new Personnage(Personnage::FORCE_PETITE,53,"ostende");
$perso2 = new Personnage(Personnage::FORCE_MOYENNE,76,"bruges");

$perso1->frapper($perso2);
$perso1->gagnerExperience();

$perso2->frapper($perso1);
$perso2->gagnerExperience();

echo 'le personnage 1 a '.$perso1->force().' de force tandis que le personnage 2 a '.$perso2->force().' de force.<br/>';
echo 'le personnage 1 a '.$perso1->experience().' de experience tandis que le personnage 2 a '.$perso2->experience().' de experience.<br/>';
echo 'le personnage 1 a '.$perso1->degats().' de degats tandis que le personnage 2 a '.$perso2->degats().' de degats.<br/>';
echo 'le personnage 2 dit :'.Personnage::parler();


?>