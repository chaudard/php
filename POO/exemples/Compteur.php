<?php
class Compteur{
	private static $_cnt = 0;

	public function __construct(){
		self::$_cnt++;
	}

	public static function cnt(){
		return self::$_cnt;
	}
}
$compteur1 = new Compteur();
$compteur2 = new Compteur();
echo Compteur::cnt();

?>