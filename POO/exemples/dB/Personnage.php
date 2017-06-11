<?php
class Personnage{
	// les attributs
	private $_id;
	private $_nom;
	private $_forcePerso;
	private $_experience;
	private $_niveau;
	private $_degats;

	// hydratation 
	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value) { // pour chaque attribut
			$method = 'set'.ucfirst($key); // le setter de l'attribut commence par 'set' et est suivi du nom de l'attribut dont la première lettre est en majuscule
			if (method_exists($this, $method)) { // si le setter de l'attribut existe
				$this->$method($value); // le setter est executé
			}
		}

		//if (isset($donnees['id'])) {
		//	this->setId($donnees['id']);
		//}
	}

	public function __construct(array $donnees){
		$this->hydrate($donnees);
	}

	// les méthodes getter
	public function id(){
		return $this->_id;
	}
	public function nom(){
		return $this->_nom;
	}
	public function forcePerso(){
		return $this->_forcePerso;
	}
	public function experience(){
		return $this->_experience;
	}
	public function niveau(){
		return $this->_niveau;
	}
	public function degats(){
		return $this->_degats;
	}

	// les méthodes setter
	public function setId($Id){
		$Id = (int) $Id;
		if ($Id > 0) {
			$this->_id = $Id;
		}
		
	}
	public function setNom($nom){
		if (is_string($nom)) {
			$this->_nom = $nom;
		}
	}
	public function setForcePerso($forcePerso){
		$forcePerso = (int) $forcePerso;
		if (($forcePerso>0)&&($forcePerso<101)) {
			$this->_forcePerso = $forcePerso;
		}
	}
	public function setDegats($degats){
		$degats = (int) $degats;
		if (($degats>-1)&&($degats<101)) {
			$this->_degats = $degats;
		}
	}
	public function setNiveau($niveau){
		$niveau = (int) $niveau;
		if (($niveau>0)&&($niveau<101)) {
			$this->_niveau = $niveau;
		}
	}
	public function setExperience($experience){
		$experience = (int) $experience;
		if (($experience>0)&&($experience<101)) {
			$this->_experience = $experience;
		}
	}
}
?>