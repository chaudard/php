<?php
class Magicien extends Combattant2{

	public function computeTimeEndormi(){
		return time() + $this->atout()*6*3600; // 6 heures en secondes, à partir de maintenant.
	}

	public function lancerSort(Combattant2 $combattant){
		$this->computeAtout();
		if ($this->id()==$combattant->id()) {
			return self::MYSELF;
		}
		if ($this->estEndormi()) {
			return self::SLEEPING;
		}
		if ($this->atout()==0) {
			return self::NOMAGIC;
		}
		// else : le combattant peut être endormi
		$combattant->setTimeEndormi($this->computeTimeEndormi());
		return self::BEWITCHED;
	}
}
?>