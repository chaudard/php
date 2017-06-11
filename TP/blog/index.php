<DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="blog.css">
		<title>Mon premier blog avec php</title>
	</head>
	<body>
		<h1>Bienvenu(e) dans le blog de dany</h1>
		<h2>voici les derniers billets du blog</h2>
		<?php
		// établissons la connexion à la db pour lister tous les billets du blog
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','root',
							array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // cette ligne pour traquer les erreurs plus facilement
		} catch(Exception $e){
			die('error : '.$e->getmessage());
		}
		// la connexion s'est bien passée
		// préparation de la requête
		// Sélection de tous les billets , dans l'ordre de création, avec la date formatée
		$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(dateCreation, "%d/%m/%Y %H:%i:%s") AS datecreation, auteur FROM blogBillets ORDER BY dateCreation DESC'); 
		$req->execute();
		while ($donnees = $req->fetch()) {
		?>
			<?php
				$showCommentsLink = true;  
				include("billet.php")
			?>
			<br/><br/><br/>
		<?php
		}
		$req->closecursor();
		?>
	</body>
</html>