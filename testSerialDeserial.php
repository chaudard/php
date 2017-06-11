<?php
class TestSerialDeserial{
	public $name = 'dany';
    public $age = 44;
}
$obj = new TestSerialDeserial();
echo '<pre>';
print_r($obj);
echo '</pre>';

echo 'serialisation</br>';
$ser = serialize($obj);
echo $ser;
echo '</br>';

echo 'deserialisation</br>';
$deser = unserialize($ser);
echo '<pre>';
print_r($deser);
echo '</pre>';
echo 'l\'age de '.$deser->name.' est de '.$deser->age.' ans.';


?>