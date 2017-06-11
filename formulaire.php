<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>monPremierFormulairePHP</title>
	</head>
	<body>
		<form method="post" action="cible.php">
			Entre ton pseudo : <br/>
			<input type="text" name="pseudo" value="myPseudo"> <label for="pseudo">mon label de pseudo</label> <br/>
			<textarea name="zoneText" rows="8" cols="45">Ceci est le contenu de ma zone de texte.</textarea><br/>
			Dans quel pays habites-tu ?<br/>
			<select name="choixPays">
				<option value="choixPays1">France</option>
				<option value="choixPays2" selected="selected">Belgique</option>
			</select>
			<br/>
			Quels sont tes repas préférés ?
			<br/>
			<input type="checkbox" name="repasFrites" checked="checked"> <label for="repasFrites">Frites</label> 
			<input type="checkbox" name="repasPizza"> <label for="repasPizza">Pizza</label> 
			<br/>
			Es-tu un homme ?
			<input type="radio" name="sexe" value="oui" checked="checked" id="oui"><label for="oui">oui</label>
			<input type="radio" name="sexe" value="non" id="non"><label for="non">non</label>
			<br/>
			<input type="hidden" name="hiddendata" value="myPassword">
			<br/>
			<input type="submit" name="valider"><br/>
		</form>
	</body>
</html>