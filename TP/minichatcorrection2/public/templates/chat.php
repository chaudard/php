<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <title>Mini chat</title>
    </head>
    <body>
    	<h1 class="title">Bienvenue dans le mini chat</h1>
    	<div class="chat">
	        <form method="post" action="index.php">
			    <p class="pseudo">
			    	<?php
			    		if(isset($noPseudo)){
			    			if($noPseudo == 1){
			    				echo("<p class=\"error\">Veuillez absolument saisir un pseudo 1 à 50 caractères et sans espace !</p>");
			    			}	
			    		}
			    	?>
			        <label for="pseudo">Votre pseudo :</label>
			        <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo de 1 à 50 caractères et sans espace" size="50" maxlength="50" <?php if(isset($_COOKIE['pseudo'])){ echo("value=\"". $_COOKIE['pseudo'] . "\"");} ?> />
			    </p>
			    <p>
			        <label for="message">Saisissez votre message :</label><br />
			       	<p><textarea name="message" id="message" placeholder="Saisissez ici votre message"></textarea></p>
			    </p>
			    <p>
			    	<input class="input" type="submit" value="Envoyer" />
			    </p>
			</form>
		</div>
		<div class="messages">
			<?php 
				while($data = $dataMessages->fetch()) 
				{
					$date = new DateTime(trim($data['date_message']));
			?>
					<p class="pseudo_message"> - <strong><?php echo(htmlspecialchars($data['pseudo'])) ?></strong> le <?php  echo(htmlspecialchars($date->format('d-m-Y à H:i:s'))) ?>, a dit :</p>
	       			<p class="message"><?php  echo(htmlspecialchars($data['message'])) ?><br /></p>
			<?php  
				}
			?>
		</div>
		<div class="pages">
			<p> Page(s) : 
				<?php
					$pageNb = $pageNb / 10;
					$j = 1;
					for ($i=0; $i < $pageNb; $i++) { 
						echo('<a href="index.php?page=' . $j . '">' . $j .  ' </a>  ');
						$j++;
					}
					$dataMessages->closeCursor();
				?>
			</p>
		</div>
    </body>
</html>