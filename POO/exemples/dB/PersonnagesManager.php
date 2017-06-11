<?php
class PersonnagesManager{
	private $_db;// soit une base de donnees avec une table personnages

	public function __construct($db){
		$this->setDb($db);
	}

	public function setDb(PDO $db){
		$this->_db = $db;
	}

	// CRUD : create, read, update, delete

	// create (= ajout en base de donnees)
	public function add(Personnage $perso){
		$req = $this->_db->prepare('INSERT INTO personnages (nom, forcePerso, experience, niveau, degats) 
											VALUES (:nom, :forcePerso, :experience, :niveau, :degats)');
		$req->execute(array('nom' => $perso->nom(),
							'forcePerso' => $perso->forcePerso(),
							'experience' => $perso->experience(),
							'niveau' => $perso->niveau(),
							'degats' => $perso->degats()
						));

		$req->closecursor();
	}

	// read (on peut lire 1 entrée en particulier ou toute la table)
	public function get($id){
		$id = (int) $id;
		$req = $this->_db->prepare('SELECT id, nom, forcePerso, experience, niveau, degats FROM personnages WHERE id = '.$id);
		$req->execute();
		$donnees = $req->fetch(PDO::FETCH_ASSOC);
		return new Personnage($donnees);
		$req->closecursor();
	}
	public function getList(){
		$persos = [];
		$req = $this->_db->prepare();
		$req->execute('SELECT * FROM personnages ORDER BY nom');
		while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
			$persos[] = new Personnage($donnees);
		}
		return $persos;
		$req->closecursor();
	}

	// update
	public function update(Personnage $perso){
		$req = $this->_db->prepare('UPDATE personnages SET forcePerso=:forcePerso, experience=:experience, niveau=:niveau, degats=:degats WHERE id = '.$perso->id()); 
		// le personnage ne change pas de nom
		$req->execute(array('forcePerso' => $perso->forcePerso(), 
							'experience' => $perso->experience(), 
							'niveau' => $perso->niveau(), 
							'degats' => $perso->degats()
							));
		$req->closecursor();
	}

	// delete
	public function delete(Personnage $perso){
		$req = $this->_db->prepare('DELETE FROM personnages WHERE id = '.$perso->id());
		$req->execute();
		$req->closecursor();
	}
}
?>