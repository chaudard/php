<?php
	// testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
	if (isset($_FILES['nomFichier']) and $_FILES['nomFichier']['error']==0) {
		// testons si le fichier envoyé n'est pas trop gros
		$sizeMax = 1000000; // 1 Mo
		if ($_FILES['nomFichier']['size'] <= $sizeMax) {
			// testons si le fichier a une extension autorisée
			$infosFichier = pathinfo($_FILES['nomFichier']['name']);
			$extensionUpload = $infosFichier['extension'];
			$extensionsAutorisees = array('jpg','jpeg','gif','png');
			if (in_array($extensionUpload, $extensionsAutorisees)){
				$tmpName = $_FILES['nomFichier']['tmp_name'];
				echo 'transfert du fichier '.$tmpName.'<br/>'; 
				$destination = 'uploads/'.basename($_FILES['nomFichier']['name']);
				echo 'vers : '.$destination.'<br/>';
				move_uploaded_file($tmpName, $destination);
				echo 'L\'envoi a bien été effectué';
			}
			else
			{
				echo 'les extensions autorisées sont : jpg, jpeg, gif, png';
			}
		}
		else
		{
			echo 'le fichier ne peut pas dépasser 1Mo';
		}
		
	}
	else{
		echo 'le fichier n\'a pas été envoyé';
	}
?>