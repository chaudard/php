<?php
class CombattantManager{
	const COMBATTANTTABLENAME = 'combattant';

	private $_db; // une base de donnees avec la table combattant

	public function __construct(PDO $db){
		$this->setDb($db);
	}
	public function db(){
		return $this->_db;
	}
	private function setDb(PDO $db){
		$this->_db = $db;
	}
	// CRUD : create, read , update , delete
	public function add(Combattant $combattant){
		if (isset($combattant)) {
			$req = $this->db()->prepare('INSERT INTO combattant (nom, degats)  VALUES (:nom,:degats)');
			$req->execute(array('nom' => $combattant->nom(), 'degats' => Combattant::STARTDEGATS));
			$req->closecursor();
			// lorsque le combattant a été inséré en db , on peut connaîte son id et lui assigner
			// nous devons réhydrater le combattant avec de nouvelles valeurs
			$combattant->hydrater(['id',$this->db()->lastInsertId()]);
		}
	}
	public function count(){ // le nombre de combattants
		$req = $this->db()->prepare('SELECT COUNT(*) FROM combattant');
		$req->execute();
		return $req->fetchColumn();
		$res->closecursor();
	}
	public function delete(Combattant $combattant){ // suppression de combattant
		$req = $this->db()->prepare('DELETE FROM  combattant WHERE id = '.$combattant->id());
		$req->execute();
		$req->closecursor();
	}
	public function exists($info){ // si l'id ou le nom d'un combattant existe
		if (is_int($info)) {
			$req = $this->db()->prepare('SELECT COUNT(*) FROM combattant WHERE id = '.$info);
			$req->execute();
			return (bool) $req->fetchColumn();
			$req->closecursor();
		}
		// si nous sommes ici c'est que nous ne sommes pas passés dans le return de la condition précédente
		// cherchons donc si le combattant existe en fonction du nom
		$req = $this->db()->prepare('SELECT COUNT(*) FROM combattant WHERE nom = :nom');
		$req->execute(array('nom' => $info));
		return (bool) $req->fetchColumn();
		$req->closecursor();
	}
	public function get($info){ // le combattant en fonction de son id ou de son nom
		if (is_int($info)){
			$req = $this->db()->prepare('SELECT * FROM combattant WHERE id =:id');
			$req->execute(array('id' => $info));
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			$combattant = new Combattant($donnees);
			$req->closecursor();
			return $combattant;
		} else {
			// nous présumons ici que info est une chaîne de caractères représentant le nom du combattant
			$req = $this->db()->prepare('SELECT * FROM combattant WHERE nom =:nom');
			$req->execute(array('nom' => $info));
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			$combattant = new Combattant($donnees);
			$req->closecursor();
			return $combattant;
		}

	}
	public function getOthers($nom){ // les autres combattants que le combattant nom
		$others = [];
		$req = $this->db()->prepare('SELECT * FROM combattant WHERE nom <> :nom ORDER BY nom');
		$req->execute(array('nom' => $nom));
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
			$combattant = new Combattant($donnees);
			$others[] = $combattant;
		}
		$req->closecursor();
		return $others;
	}
	public function update(Combattant $combattant){
		$req = $this->db()->prepare('UPDATE combattant SET degats =:degats WHERE id=:id');
		$req->execute(array('degats' => $combattant->degats(), 'id' => $combattant->id()));
		$req->closecursor();
	}

}
?>