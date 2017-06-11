<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="minichat.css">
		<title>Mon mini-chat</title>
	</head>
	<body>
		<h1>Bienvenu(e) sur mon mini-chat !</h1>
		<p>
			<em>Veuillez introduire votre pseudo et votre message ...</em>
			<form method="POST" action="minichat_post.php">
				<!-- insertion du pseudo -->
				<label for="pseudo">pseudo</label>
				<br/> 
				<!-- récupérons le cookie qui stoque la valeur du pseudo-->
				<?php
				$pseudo = '';
				if (isset($_COOKIE['pseudoMinichat']) && !empty($_COOKIE['pseudoMinichat'])){
					$pseudo = htmlspecialchars($_COOKIE['pseudoMinichat']);
				}
				echo '<input type="text" name="pseudo" id="pseudo" value="'.$pseudo.'">';
				?>
				<!--  <input type="text" name="pseudo" id="pseudo">  -->
				<br/>
				<!-- insertion du commentaire--> 
				<label for="commentaire">message</label>
				<br/>
				<input type="text" name="commentaire" id="commentaire" size="100">
				<br/>
				<!-- insertion du bouton de soumission-->
				<input type="submit" name="envoyer">
				<br/>
				<!-- affichage des 10 derniers chats -->
				<?php
				// connexion à la db
				try{
					$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root',
									array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				} catch (Exception $e) {
					die('Error : '.$e->getMessage());
				}
				$req = $bdd->prepare('SELECT pseudo, commentaire, DATE_FORMAT(dateCreation, "%d/%m/%Y à %Hh%imin%ss") AS datecreation FROM minichat ORDER BY id DESC LIMIT 0,10');
				$req->execute();
				while ($donnees = $req->fetch()) {
					echo '<p>
							<strong id="pseudo">'.htmlspecialchars($donnees['pseudo']).'</strong>
							<em id="date"> ( le '.htmlspecialchars($donnees['datecreation']).' )</em>
							<br/>
							<div id="message">
							'.htmlspecialchars($donnees['commentaire']).'
							</div>
							<br/>
							</p>';
				}
				$req->closecursor();
				?>
			</form>
		</p>
	</body>
</html>
