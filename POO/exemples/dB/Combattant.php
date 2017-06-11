<?php
class Combattant{
	const SHOOTHIMSELF = 0;
	const DEAD = 1;
	const SHOOTED = 2;
	const MAXDEGATS = 100;
	const DEGATS = 5;
	const STARTDEGATS = 0;

	private $_id; // en db
	private $_nom;
	private $_degats;

	public function hydrater(array $donnees){
		if (isset($donnees)) {
			foreach ($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
	}
	public function __construct(array $donnees){
		$this->_degats = self::STARTDEGATS;
		$this->hydrater($donnees); // le tableau ne devrait contenir que le nom car les degats = STARTDEGATS au départ
	}

	public function id(){
		return $this->_id;
	}
	private function setId($id){
		$id = (int) $id;
		if ($id > 0) {
			$this->_id = $id;
		}
	}
	public function nom(){
		return $this->_nom;
	}
	private function setNom($nom){
		if (is_string($nom)) {
			if (!empty($nom)) {
				$this->_nom = $nom;
			}
		}
	}
	public function degats(){
		return $this->_degats;
	}
	private function setDegats($degats){
		$degats = (int) $degats;
		if (($degats>0)&&($degats<=self::MAXDEGATS)) {
			$this->_degats += $degats;
		}
	}
	public function attaquer(Combattant $combattant){
		// verifions d'abords que le combattant ne s'attaque pas lui-même
		if ($this->id()!=$combattant->id()) {
			return $combattant->souffrir();
		} else {
			// signalons que le combattant ne peut pas se frapper lui-même
			return self::SHOOTHIMSELF;
		}
	}
	public function souffrir(){
		$this->setDegats(self::DEGATS);
		if ($this->degats()>=self::MAXDEGATS) {
			return self::DEAD;
		} else {
			return self::SHOOTED;
		}
	}
}
?>