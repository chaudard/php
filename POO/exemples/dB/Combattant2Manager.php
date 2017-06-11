<?php
class Combattant2Manager{
	private $_db;

	public function __construct(PDO $db){
		$this->setDb($db);
	}

	public function db(){
		return $this->_db;
	}
	public function setDb(PDO $db){
		$this->_db=$db;
	}

	public function add(Combattant2 $combattant){
		// il faut l'ajouter à la db et récupérer l'id pour réhydrater le combattant
		$req = $this->db()->prepare('INSERT INTO Combattant2 (nom,type) VALUES (:nom,:type)');
		$req->execute(array('nom' => $combattant->nom(), 'type' => $combattant->type()));
		$id = $this->db()->lastInsertId();
		$donnees[] = $id;
		$combattant->hydrate($donnees);
		$req->closecursor();
	}

	public function count(){
		$req = $this->db()->prepare('SELECT COUNT(*) FROM Combattant2');
		$req->execute();
		return $req->fetchColumn();
		$req->closecursor();
	}

	public function delete(Combattant2 $combattant){
		$req = $this->db()->prepare('DELETE FROM Combattant2 WHERE id=:id');
		$req->execute(array('id' => $combattant->id()));
		$req->closecursor();
	}

	public function exists($info){
		// $info pourrait être l'id du combattant ou son nom
		$result = false;
		if (is_int($info)) {
			$req = $this->db()->prepare('SELECT COUNT(*) FROM Combattant2 WHERE id=:id');
			$req->execute(array('id' => $info));
			$result = (bool) $req->fetchColumn();
			$req->closecursor();
		} else {
			$req = $this->db()->prepare('SELECT COUNT(*) FROM Combattant2 WHERE nom=:nom');
			$req->execute(array('nom' => $info));
			$result = (bool) $req->fetchColumn();
			$req->closecursor();
		}
		return $result;
	}

	public function get($info){
		// $info peut être un id ou un nom de combattant
		// la méthode doit renvoyer une instance de la bonne classe en fonction de la valeur type
		if (is_int($info)) {
			$req = $this->db()->prepare('SELECT id, nom, degats, type, atout, timeEndormi FROM Combattant2 WHERE id=:id');
			$req->execute(array('id'=> $info));
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			$req->closecursor();
		} else {
			$req = $this->db()->prepare('SELECT id, nom, degats, type, atout, timeEndormi FROM Combattant2 WHERE nom=:nom');
			$req->execute(array('nom'=> $info));
			$donnees = $req->fetch(PDO::FETCH_ASSOC);
			$req->closecursor();
		}
		$type = $donnees['type'];
		switch ($type) {
			case 'guerrier':
				return new Guerrier($donnees);
				break;
			case 'magicien':
				return new Magicien($donnees);
				break;
			default:
				return null;
				break;
		}
	}

	public function getOthers($nom){
		// nous renvoyons la liste des autres combattants que 'nom' , bref les adversaires de 'nom'
		$others = [];
		$req = $this->db()->prepare('SELECT * FROM Combattant2 WHERE nom<>:nom ORDER BY nom');
		$req->execute(array('nom'=> $nom));
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
			switch ($donnees['type']) {
				case 'magicien':
					$others[] = new Magicien($donnees);
					break;
				case 'guerrier':
					$others[] = new Guerrier($donnees);
					break;
			}
		}
		$req->closecursor();
		return $others;
	}

	public function update(Combattant2 $combattant){
		$req = $this->db()->prepare('UPDATE Combattant2 SET degats=:degats, timeEndormi=:timeEndormi, atout=:atout WHERE id=:id');
		$req->execute(array('degats'=> $combattant->degats(), 'timeEndormi' => $combattant->timeEndormi(), 'atout' => $combattant->atout()));
		$req->closecursor();
	}
}
?>