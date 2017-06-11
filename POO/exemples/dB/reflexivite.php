<?php
function chargerClass($class){
	require $class.'.php';
}
spl_autoload_register('chargerClass');

// reflexivite = inspection de l'objet au niveau de ses attributs et de ses méthodes


//$classMagicien = new ReflectionClass('Magicien');
$magicien = new Magicien(['nom' => 'harry']);
$classMagicien = new ReflectionObject($magicien);

//echo $magicien->nom();
if ($classMagicien->hasProperty('degats')) { // hasMethod pour tester si la classe possède la méthode
	echo 'La classe magicien possède l\'attribut "degats" </br>';
} else {
	echo 'La classe magicien ne possède pas l\'attribut "degats" </br>';
}

if ($parent = $classMagicien->getParentClass()) {
	echo 'La classe parent de '.$classMagicien->getName().' est '.$parent->getName();
} else {
	echo 'La classe '.$classMagicien->getName().'n\'a pas de classe parent.';
}

$attributsMagicien = $classMagicien->getProperties();
echo '<pre>';
print_r($attributsMagicien);
echo '</pre>';

?>