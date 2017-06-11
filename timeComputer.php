<?php
if (isset($_POST['calcul'])) {
	if ( (!isset($_POST['date1']) && !isset($_POST['date2'])) || (empty($_POST['date1']) && empty($_POST['date2'])) ) {
		$message = 'Veuillez entrer les deux dates.';
	} elseif (!isset($_POST['date1']) || empty($_POST['date1'])) {
		$message = 'Veuillez entrer la première date.';
	} elseif (!isset($_POST['date2']) || empty($_POST['date2'])) {
		$message = 'Veuillez entrer la deuxième date.';
	} else {
		try {
			$datetime1 = new DateTime($_POST['date1']);
			$datetime2 = new DateTime($_POST['date2']);
			$diff = $datetime1->diff($datetime2);
		} catch (Exception $e) {
			$message = 'Au moins une des deux dates est incorrecte. ';//.$e->getMessage();
		}
	}
}
if (isset($_POST['date1'])) {
	$date1 = htmlspecialchars($_POST['date1']);
}
if (isset($_POST['date2'])) {
	$date2 = htmlspecialchars($_POST['date2']);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Calcul de la différence entre 2 dates</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Bienvenu(e) dans l'application qui calcule la différence entre 2 dates</h1>
	<form method="POST" action="timeComputer.php">
		<p>
			Les dates à entrer sont de type : 2017-01-01 </br>
			date 1 : <input type="date" name="date1" value="<?php echo $date1; ?>"> </br>
			date 2 : <input type="date" name="date2" value="<?php echo $date2; ?>"> </br>
			<input type="submit" name="calcul" value="calcul">
		</p>
	</form>
</body>
</html>
<?php
	if (isset($diff)) {
		$diffS = $diff->format("%Y année(s) %m mois %d jour(s).");
		echo 'La difference est de '.$diffS;
	}
	if (isset($message)){
		echo $message;
	}
?>