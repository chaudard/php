<?php
	// préparons toute la partie php avec la gestion des combattants

// chargeons les classes nécessaires avec un autoload
function chargerClasse($nomClasse){
	require $nomClasse.'.php';
}
spl_autoload_register('chargerClasse');

session_start();

if (isset($_GET['deconnexion'])) {
	session_destroy();
	header('location: .');
	exit();
}
if (isset($_SESSION['combattant'])) {
	$combattant = $_SESSION['combattant'];
}

// création d'un manager de combattant lié à une db de combattants
try{
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','root',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e){
	die('Error :'.$e->getmessage());
}
// la connexion à la db s'est bien passée

$manager = new CombattantManager($db);

function validName($name){
	$result = !empty($name);
	return $result;
}

$message = "";
//$combattant = null;
// cas 1 : le joueur veut créer un nouveau combattant
// il faut vérifier que le nom est valide (pas vide) et qu'il n'existe pas encore; auquel cas, il faut renvoyer un message
if (isset($_POST['combattantName']) && isset($_POST['createCombattant'])) {
	$combattantName = htmlspecialchars($_POST['combattantName']);
	if (!validName($combattantName)) {
		$message = 'Le nom du combattant n\'est pas valide.';
	} elseif ($manager->exists($combattantName)) {
		$message = 'Ce combattant existe déjà.';
	} else {
		$combattant = new Combattant(['nom' => $combattantName]);
		$manager->add($combattant);
	}
} elseif (isset($_POST['combattantName']) && isset($_POST['chooseCombattant'])) {
	// c'est comme si on se logait avec ce combattant
	$combattantName = htmlspecialchars($_POST['combattantName']);
	if (!validName($combattantName)) {
		$message = 'Le nom du combattant n\'est pas valide.';
	} elseif (!$manager->exists($combattantName)) {
		$message = 'Ce combattant n\'existe pas.';
	} else {
		$combattant = $manager->get($combattantName);
		$choixCombattant = true;
	}
} elseif (isset($_GET['frapper'])) {
	if (!isset($combattant)) {
		$message = 'Veuillez créer un personnage ou vous identifier.';
	} else {
		$idCombattant = (int) $_GET['frapper'];
		echo $idCombattant;
		if (!$manager->exists($idCombattant)){
			$message = 'Le combattant que vous voulez frapper n\'existe pas.';
		} else {
			$otherCombattant = $manager->get($idCombattant);
			$retour = $combattant->attaquer($otherCombattant);
			switch ($retour) {
				case Combattant::SHOOTHIMSELF:
					$message = 'Vous ne pouvez pas vous frapper vous-même.';
					// pas de mise à jour nécessaire.
					break;
				case Combattant::SHOOTED:
					$message = $otherCombattant->nom().' a bien été frappé';
					// mise à jour du combattant en db
					$manager->update($otherCombattant);
					break;
				case Combattant::DEAD:
					$message = $otherCombattant->nom().' est à présent mort!';
					// suppression du combattant en db
					$manager->delete($otherCombattant);
					break;
			}
		}
	}
}

// cas 2 : le joueur veut choisir un combattant pour jouer
// il faut vérifier que le nom qu'il a introduit se trouve bien en db; auquel cas, il faut renvoyer un message

?>
<!-- création du formulaire dans une page html -->
<!DOCTYPE html>
<html>
<head>
	<title>jeu des combattants</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>BIENVENU DANS LE JEU DES COMBATTANTS</h1>
	<!-- affichons le nombre de combattants existants-->
	<p>
		Nombre de combattants existants = 
		<?php
			$nbr = $manager->count();
			echo $manager->count().'</br>'; // un manager de combattant a été créé dans la partie php
			for ($i=0; $i < $nbr; $i++) { 
				$combattanti = $manager->get($i+1);
				echo $combattanti->nom().' ('.$combattanti->degats().') </br>';
			}
		?>
	</p>
	<p>
		<?php
	    // affichons un message d'erreur s'il y en a un
		if (!empty($message)) {
			echo $message;
		}
		if (isset($combattant)) {
			// un combattant a été choisi ; affichons ses informations et les autres combattants à combattre
			?>
				<!-- ajoutons un lien de deconnexion -->
				<p>
					<a href="jeuCombattants.php?deconnexion=1">deconnexion</a>
				</p>
				<fieldset> <!-- création d'un cadre autour des informations -->
					<legend>Informations du combattant choisi</legend> <!-- titre du cadre -->
					<p>
						Nom : <?= htmlspecialchars($combattant->nom()) ?> <br/>
						degats : <?= $combattant->degats() ?> <br/>
					</p>
				</fieldset>
				<fieldset>
					<legend>Qui frapper ?</legend>
					<p>
						<?php
						// voyons s'il y des combattants à frapper
						$others = $manager->getOthers($combattant->nom());
						if (empty($others)) {
							echo 'Personne o frapper. Veuillez créer de nouveaux combattants.';
						} else {
							// affichons chaque autre combattant en lui associant un lient qui permettra de récupérer le combattant frappé dans un get
							foreach ($others as $other) {
								if ($other->degats()<Combattant::MAXDEGATS){
								echo '<a href="?frapper='.$other->id(). '">'.htmlspecialchars($other->nom()).'</a>  (degats : '.$other->degats().' ) <br/>';
								}
							}
						}
						?>
					</p>
				</fieldset>
			<?php
		} else {
		?>
			<!-- affichons un formulaire qui permettra de créer un nouveau combattant ou d'en utiliser un dans la liste -->
			<p>
				<form method="post" action=""> <!-- action est vide car on utilise le même fichier pour l'envoi et la réception -->
					nom du combattant : <input type="text" name="combattantName" maxlength="50"> <!-- attention le 50 doit être cohérent avec la taille du champ en db-->
					<input type="submit" name="createCombattant" value="créer">
					<input type="submit" name="chooseCombattant" value="choisir">
				</form>
			</p>
		<?php
		}
		?>
	</p>
</body>
</html>
<?php
// mémorisons le combattant qui est logé
if (isset($combattant)) {
	$_SESSION['combattant'] = $combattant;
}
?>