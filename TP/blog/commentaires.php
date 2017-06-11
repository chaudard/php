<DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="blog.css">
		<title>Les commentaires du billet</title>
	</head>
	<body>
		<h1>Voici les commentaires du billet.</h1>
		<div>
			<a id="retourBillets" href="index.php"><em>retour aux billets</em></a>
			<br/>
		</div>
		<?php 
			// connexion à la db
			try {
				$bdd = new PDO('mysql:host=localhost;dbname=test','root','root',
								array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				
			} catch (Exception $e) {
				die('Error : '.$e->getmessage());
			}
			// la connexion s'est bien passée
			if (isset($_GET['idBillet'])){
				$idBillet = (int) $_GET['idBillet'];
				if (($idBillet>0)&&($idBillet<1000000)){ // prenons une sécurité
					// récupérons le billet
					$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(dateCreation, "%d/%m/%Y %H:%i:%s") AS datecreation, auteur FROM blogBillets WHERE id=:idBillet');
					$req->execute(array(
						'idBillet' => $idBillet
						));
					// il n'y a qu'un seul billet avec cet id
					$donnees = $req->fetch();
					?>
					<?php 
						$showCommentsLink = false;
						include("billet.php"); 
					?>
					<?php
					$req->closecursor();

					// récupérons les commentaires du billet
					$req = $bdd->prepare('SELECT auteur, contenu, DATE_FORMAT(dateCreation, "%d/%m/%Y %H:%i:%s") AS datecreation FROM blogCommentaires WHERE idBillet=:idBillet  ORDER BY dateCreation DESC');
					$req->execute(array(
						'idBillet' => $idBillet
						));
					$commentairesCount = 0;
					while ($donnees = $req->fetch()) {
						$commentairesCount += 1;
					}

					if ($commentairesCount>0){
						echo('</br><h2>Commentaires</h2>');
						$req->closecursor();
						$req->execute(array(
							'idBillet' => $idBillet
							));
						while ($donnees = $req->fetch()) {
							?>
							<br/>
							<strong><?php echo(htmlspecialchars($donnees['auteur'])); ?></strong>  <em> le <?php echo(htmlspecialchars($donnees['datecreation'])); ?></em>
							<br/>
							<?php echo(htmlspecialchars($donnees['contenu']).'<br/>') ?>
							<?php
						}
					}
					else{
						echo('Pas de commentaire pour ce billet.');
					}
					$req->closecursor();
				}
			}
		?>
		
	</body>
</html>