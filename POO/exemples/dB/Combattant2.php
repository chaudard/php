<?php
abstract class Combattant2{
	protected $id;
	protected $nom;
	protected $degats;
	protected $type;
	protected $atout;
	protected $timeEndormi; // heure jusque laquelle le combattant est endormi

	const DEGATS = 5;
	const MAXDEGATS = 100;

	const MYSELF = 1; // se frappe lui-même
	const DEAD = 2; // est mort
	const KICKED = 3; // est touché par une attaque
	const BEWITCHED = 4; // est ensorcelé
	const NOMAGIC = 5; // pas de magie
	const SLEEPING = 6; // endormi

	public function hydrater(array $donnees){
		if (isset($donnees)){
			foreach ($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)){
					$this->$method($value);
				}
			}
		}
	}

	public function __construct(array $donnees){
		$this->hydrater($donnees);
		$this->type = strtolower(static::class); // c'est ici que se fait le set, implicitement par le nom de la classe qui est instanciée. (il n'y aura donc pas de set car il ne peut pas être modifié)
	}

	public function id(){
		return $this->id;
	}

	public function setId($id){
		$id = (int) $id;
		if($id > 0){
			$this->id=$id;
		}
	}

	public function nom(){
		return $this->nom;
	}

	public function setNom($nom){
		if (is_string($nom) && !empty($nom)) {
			$this->nom = $nom;
		}
	}

	public function nomValide(){
		return empty($this->nom);
	}

	public function degats(){
		return $this->degats;
	}

	public function setDegats($degats){
		$degats = (int) $degats;
		if ($degats>0 && $degats<=MAXDEGATS) {
			$this->degats+=$degats;
		}
	}

	public function recevoirDegats($degats){
		$this->setDegats($degats);
		if ($this->degats()>=self::MAXDEGATS) {
			return self::DEAD;
		}
		return self::KICKED;
	}

	public function type(){
		return $this->type;
	}

	public function atout(){
		return $this->atout;
	}

	public function setAtout($atout){
		$atout = (int) $atout;
		if ($atout>=0 && $atout<5) {
			$this->atout = $atout;
		}
	}

	public function computeAtout(){
		$currentDegats = $this->degats();
		if ($currentDegats>=0 && $currentDegats<=25) {
			$this->setAtout(4);
		} elseif ($currentDegats>25 && $currentDegats<=50) {
			$this->setAtout(3);
		} elseif ($currentDegats>50 && $currentDegats<=75) {
			$this->setAtout(2);
		} elseif ($currentDegats>75 && $currentDegats<=90) {
			$this->setAtout(1);
		} else
			$this->setAtout(0);
	}

	public function timeEndormi(){
		return $this->timeEndormi;
	}

	public function setTimeEndormi($time){
		$this->timeEndormi=(int) $time;
	}

	public function estEndormi(){
		return $this->timeEndormi>time(); // time() renvoie l'heure actuelle
	}

	public function frapper(Combattant2 $combattant){
		if ($this->id()==$combattant->id()) {
			return self::MYSELF; // un combattant ne peut pas se frapper lui-même
		}
		if ($this->estEndormi()) {
			return self::SLEEPING; // un combattant ne peut pas frapper s'il est endormi
		}
		// sinon
		return $combattant->recevoirDegats();
	}

	public function reveil(){ // méthode qui renvoie le temps jusqu'au réveil du combattant
		$seconds = $this->timeEndormi() - time(); // nombre de secondes restantes jusqu'au réveil
		// décortiquons les secondes en heures, minutes et secondes.
		$heures = floor($seconds/3600);
		$seconds-=$heures*3600;
		$minuts = floor($seconds/60);
		$seconds-=$minuts*60;

		// ajoutons à chaque valeur le suffixe (chaîne de caractères) approprié (plusieurs s'il y en a plusieurs)
		$heures .= $heures <= 1 ? ' heure':' heures';// .= signifie qu'on ajoute une chaîne de caractères
		$minuts .= $minuts <= 1 ? ' minute':' minutes';
		$seconds .= $seconds <= 1 ? ' seconde':' secondes';

		return $heures.', '.$minuts.' ,'.$seconds;
	}
} 
?>