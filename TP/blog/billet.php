	<p>
		<div id="billet">
			<mark id="auteur"><?php echo(htmlspecialchars($donnees['auteur'])) ?></mark>
			<br/>
			<p  id="titre">
				<strong id="titrePrincipal"><?php echo(htmlspecialchars($donnees['titre'])) ?></strong>  
				<em id="date"> le <?php echo(htmlspecialchars($donnees['datecreation']))?></em>
			</p>
		</div>
		<div id="contenuBillet">
			<?php echo (htmlspecialchars($donnees['contenu'])); ?>
			<br/>
			<?php 
				if ($showCommentsLink==true){
					$idBillet = htmlspecialchars($donnees['id']);
					echo ('<br/><a id="goCommentaires" href="commentaires.php?idBillet='.$idBillet.'&amp;clicComment=false"><em>commentaires...</em></a>');
				}
			?>
		</div>
	</p>
