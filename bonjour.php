<?php
if (isset($_GET['prenom'])&&isset($_GET['nom'])&&isset($_GET['repetition'])) 
{
	$repetition = (int) $_GET['repetition'];
	$prenom = $_GET['prenom'];
	$nom = $_GET['nom'];
	if (($repetition>0)&&($repetition<100)&&(!empty($prenom)&&(!empty($nom)))) 
	{
		for ($i=0; $i <$repetition ; $i++) { 
			echo 'Bonjour '.$_GET['prenom'].' '.$_GET['nom'].'. <br/>';
		}
	}
	else
	{
		echo 'les paramètres sont invalides.';
	}
}
	else
	{
		echo 'les paramètres sont invalides.';
	}

?>