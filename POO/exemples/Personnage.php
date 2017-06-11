<?php
class Personnage{

	// les attributs
	private $_force; // = 20;  initialisation si pas de constructeur
	private $_localisation;
	private $_experience;
	private $_degats;

	// déclaration des constantes de force, propres à la classe
	const FORCE_PETITE = 20;
	const FORCE_MOYENNE = 50;
	const FORCE_GRANDE = 80;

	// déclaration d'une variable de classe
	private static $_texteADire = "je suis un autre guerrier.";

	// les méthodes
	// le constructeur
	public function __construct($force,$experience,$localisation){
		$this->setForce($force);
		$this->setExperience($experience);
		$this->setLocalisation($localisation);
		$this->_degats = 0;
	}

	// les accesseurs
	public function degats(){
		return $this->_degats;
	}
	public function experience(){
		return $this->_experience;
	}
	public function localisation(){
		return $this->_localisation;
	}
	public function force(){
		return $this->_force;
	}
	// les mutateurs
		// nous allons ici contrôler la valeur d'entrée
	public function setLocalisation($localisation){
		if (!is_string($localisation)) {
			trigger_error('La localisation doit être un mot.', E_USER_WARNING);
			return;
		}
		$this->_localisation = $localisation;
	}

	public function setForce($force){
		// vérifions d'abord si force est bien un entier
		if (!is_int($force)) {
			// déclenchement d'un événement qui signale une erreur
			trigger_error('la force d\'un personnage doit être un nombre entier.', E_USER_WARNING);
			return; // termine la function ; le code qui suit ne sera pas executé.
		}
		// vérifions aussi que la force ne dépasse pas 100
		if ($force>100) {
			trigger_error('la force d\'un personnage ne peut pas dépasser 100.', E_USER_WARNING);
			return;
		}
		// vérifions aussi que la force est bien une des 3 forces possibles
		if (in_array($force, [self::FORCE_PETITE,self::FORCE_MOYENNE,self::FORCE_GRANDE])) {
			$this->_force = $force;
		}
		
	}

	public function setExperience($experience){
		// vérifions d'abord si experience est bien un entier
		if (!is_int($experience)) {
			// déclenchement d'un événement qui signale une erreur
			trigger_error('l\' experience d\'un personnage doit être un nombre entier.', E_USER_WARNING);
			return; // termine la function ; le code qui suit ne sera pas executé.
		}
		// vérifions aussi que experience ne dépasse pas 100
		if ($experience>100) {
			trigger_error('l\'experience d\'un personnage ne peut pas dépasser 100.', E_USER_WARNING);
			return;
		}
		// si on arrive ici , c'est que tout s'est bien passé : on peut affecter la valeur.
		$this->_experience = $experience;
	}

	// méthodes classiques

	public static function parler(){
		echo self::$_texteADire;
	}

	public function deplacer(){

	}

	public function frapper(Personnage $personneAFrapper){
		$personneAFrapper->_degats += $this->_force;
	}

//	public function gagnerExperience($value){
//		$this->_experience += $value;
//	}
	public function gagnerExperience(){
		$this->_experience ++;
	}

	public function afficherExperience(){
		echo $this->_experience;
	}

	public function afficherForce(){
		echo $this->_force;
	}

	public function afficherDegats(){
		echo $this->_degats;
	}
}

?>