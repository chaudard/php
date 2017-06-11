<?php
class Guerrier extends Combattant2{
	// surcharge de la méthode recevoirDegats()
	public function recevoirDegats($degats){
/*
L'atout du guerrier est indirectement proportionnel à ses degats actuels ; moins il a de dégats, plus il est fort et donc les coups qui lui sont portés ne lui font pas mal.
L'atout est en quelque sorte une parade à l'attaque.
*/
		$this->computeAtout();
		$newDegats = static::DEGATS-$this->atout();
		$parent->recevoirDegats($newDegats);
	}
}
?>