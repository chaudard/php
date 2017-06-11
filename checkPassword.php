<?php
	if (isset($_POST['myPassword'])) {
		if (htmlspecialchars($_POST['myPassword'])=='kangourou') {
			echo 'mot de passe correct';		
		}
		else{
			echo 'mot de passe incorrect. <br/>';
		}		
	}
	else {
		echo 'tu dois entrer un mot de passe.';
	}
?>