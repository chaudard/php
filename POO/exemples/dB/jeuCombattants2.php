<?php
function chargerClass($class){
	require $class.'.php';
}
spl_autoload_register('chargerClass');

session_start();

if (isset($_GET['deconnexion'])) {
	session_destroy();
	header('location: .');
	exit();
}

if (isset($_SESSION['combattant'])) {
	$combattant = $_SESSION['combattant'];
}

// connexion à la db
try{
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root', 'root',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(Exception $e){
	die('erreur : '.$e->getMessage());
}
// la connexion à la db s'est bien passée

// créons le manager de combattants
$manager = new Combattant2Manager($db);

// traitons les informations qui ont été envoyées par le formulaire

// création d'un combattant
if (isset($_POST['creerCombattant']) && isset($_POST['combattantName']) && isset($_POST['typeCombattant'])) {
	$combattantName = htmlspecialchars($_POST['combattantName']);
	if (!empty($combattantName)) {
		if (!$manager->exists($combattantName)) {
			switch ($_POST['typeCombattant']) {
				case 'magicien':
					$combattant = new Magicien(['nom' => $combattantName]);
					break;
				case 'magicien':
					$combattant = new Guerrier(['nom' => $combattantName]);
					break;
				default:
					$message = "Le type du combattant est incorrect.";
					break;
			}
		} else {
			$message = "Ce combattant existe déjà.";
		}
		
	} else {
		$message = "Le nom du combattant ne peut pas être vide.";
	}
// choix d'un combattant
} elseif (isset($_POST['choisirCombattant']) && isset($_POST['combattantName'])) {
	$combattantName = htmlspecialchars($_POST['combattantName']);
	if (!empty($combattantName)) {
		if ($manager->exists($combattantName)) {
			$combattant = $manager->get($combattantName);
		} else {
			$message = "Ce combattant n'existe pas.";
		}
	} else {
		$message = "Le nom du combattant ne peut pas être vide.";
	}
// frappe un autre combattant (cette instruction est passée directement dans l'url, on la récupère donc à l'aide d'un $_GET)
} elseif (isset($_GET['frapper'])) {
	if (!isset($combattant)) {
		$message = "Veuillez créer ou choisir un combattant.";
	} else {
		$id = (int) $_GET['frapper']; // renvoie 0 si ce n'est pas un entier
		if (!$manager->exists($id)) {
			$message = "Le combattant que vous voulez frapper n'existe pas.";
		} else {
			$other = $manager->get($id);
			$retour = $combattant->frapper($other);
			switch ($retour) {
				case Combattant2::MYSELF:
					$message = "C'est spécial de se frapper sois-même!!!!!";
					break;
				case Combattant2::KICKED:
					$message = "Le coup a bien été porté à votre adversaire.";
					$manager->update($other);
					$manager->update($combattant);
					break;
				case Combattant2::DEAD:
					$message = "Le coup a été fatal à votre adversaire. Il est mort !";
					$manager->delete($other);
					$manager->update($combattant);
					break;
				case Combattant2::BEWITCHED:
					$message = "Vous êtes ensorcelé. Vous ne pouvez pas frapper vos adversaires.";
					break;
			}
		}
	}
// ensorceler un adversaire
} elseif (isset($_GET['ensorceler'])) {
	if (!isset($combattant)) {
		$message = "Veuillez créer ou choisir un combattant.";
	} else {
		if ($combattant->type()!='magicien') {
			$message = "Seuls les magiciens peuvent ensorceler.";
		} else {
			$id = (int) $_GET['ensorceler'];
			if (!$manager->exists($id)) {
			$message = "Le combattant que vous voulez ensorceler n'existe pas.";
			} else {
				$other = $manager->get($id);
				$retour = $combattant->lancerSort($other);
				switch ($retour) {
					case Combattant2::MYSELF:
						$message = "C'est curieux de vouloir s'ensorceler!!!!";
						break;
					case Combattant2::BEWITCHED:
						$message = "L'adversaire a bien été ensorcelé.";
						$manager->update($other);
						$manager->update($combattant);
						break;
					case Combattant2::NOMAGIC:
						$message = "Vous n'avez plus de magie.";
						break;
					case Combattant2::SLEEPING:
						$message = "Vous êtes endormi. Vous ne pouvez pas lancer de sort.";
						break;
				}
			} 
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>jeu des combattants(2)</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>JEU DES COMBATTANTS (2)</h1>
	<!-- affichons le nombre de combattants existants suivants leur type-->
	<p>
		Nombre de combattants : <?= $manager->count() ?> </br>
		<?php
		for ($i=0; $i < $manager->count(); $i++) { 
			$combattanti = $manager->get($i+1);
			echo $combattanti->nom().' ( '.$combattanti->type().' )</br>';
		}
		?>
	</p>
	<?php
	if (isset($message)) {
		echo '<p>'.$message.'</p>';
	}
	if (isset($combattant)) {
		// on affiche les infos du combattant mais on lui donne aussi la possibilité de se déconnecter (se retirer du jeu)
		echo '<p><a href="jeuCombattants2.php?deconnexion=1">Deconnexion</a></p>';
	?>
		<fieldset>
			<legend>données du combattant qui joue</legend>
			<p>
			Type : <?= $combattant->type() ?> </br>
			Nom : <?= $combattant->nom() ?> </br>
			Degats : <?= $combattant->degats() ?> </br>
			<?php
			// affichons l'atout en fonction du type
			// magie pour un magicien et protection pour un guerrier
			switch ($combattant->type()) {
				case 'magicien':
					echo 'Magie';
					break;
				case 'guerrier':
					echo 'Protection';
					break;
			}
			echo ' : '.$combattant->atout();
			?>
			</p>
		</fieldset>
		<fieldset>
			<legend>Qui attaquer ?</legend>
			<p>
				<?php
				// nous allons lister tous les autres combattants 
				$others = $manager->getOthers($combattant->nom());
				if (isset($others)) {
					if (empty($others)) {
						echo 'Personne à frapper.';
					}elseif ($combattant->estEndormi()) {
						echo 'Un magicien vous a endormi. Vous vous réveillerez dans : '.$combattant->reveil();
					}else{
					foreach ($others as $other) {
						echo '<a href="?frapper='.$other->id().'">'.htmlspecialchars($other->nom()).'</a> ( '.$other->type().' : dégats = '.$other->degats().' ) ';
						// juste derrière , ajoutons un lien pour ensorceler l'adversaire , si le combattant courant est un magicien
						if ($combattant->type()=="magicien") {
							echo '<a href="?ensorceler='.$other->id().'">ensorceler</a>';
						}
						echo '</br>';
					}
					}
				}
				?>
			</p>
		</fieldset>
	<?php
	}else{

	?>
	<!-- affichons à présent le formulaire afin de créer ou choisir un combattant -->
	<p>
		<form method="post" action="">
			nom du combattant :
			<input type="text" name="combattantName" maxlength="50">
			<input type="submit" name="choisirCombattant" value="Choisir">
			</br>
			<!-- donnons au joueur la possibilité de choisir entre un guerrier et un magicien -->
			Type : 
			<select name="typeCombattant">
				<option value="magicien" >Magicien</option>
				<option value="guerrier">Guerrier</option>
			</select>
			<input type="submit" name="creerCombattant" value="Créér">
		</form>
	</p>
	<?php
	}
	?>

</body>
</html>

<?php

if (isset($combattant)) {
  $_SESSION['combattant'] = $combattant;
}
?>