<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<title>test include</title>
	</head>
	<body>
		<?php include("include/entete.php") ?>
		<br/> Ceci est la partie qui n'est pas incluse dans un autre fichier <br/>
		<?php include("include/piedPage.php") ?>
	</body>
</html>