<?php
class MaClasse
{
  private $attributs = [];
  private $unAttributPrive;
  
  public function __set($nom, $valeur)
  {
    $this->attributs[$nom] = $valeur;
  }
  
  public function afficherAttributs()
  {
    echo '<pre>', print_r($this->attributs, true), '</pre>';
  }

  public function __get($nom)
  {
    return 'Impossible d\'accéder à l\'attribut <strong>' . $nom . '</strong>, désolé !<br />';
  }
}

$obj = new MaClasse;

$obj->attribut = 'Simple test';
$obj->unAttributPrive = 'Autre simple test';

echo $obj->attribut;
echo $obj->unAttributPrive;

$obj->afficherAttributs();