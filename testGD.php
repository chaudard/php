<?php

// affichage d'une image colorée en orange transparent , avec un texte et des formes

header("Content-type: image/png"); // pour que le script crée une image
$image = imagecreate(200,300); // création de l'image vierge
$orange = imagecolorallocate($image, 255, 128, 0); // pour donner la couleur de fond à l'image 
$bleu = imagecolorallocate($image, 0, 0, 255);  // création de la couleur bleue
$noir = imagecolorallocate($image, 0, 0, 0);  // création de la couleur noire
imagestring($image, 3, 20, 30, "hello world", $bleu); // affichage d'un texte
imagesetpixel($image, 100, 100, $noir); // affichage d'un pixel (on ne le voit pas à l'écran)
imageline($image, 10, 10, 190, 190, $noir);	// affichage d'une ligne
imageellipse($image, 50, 250, 80, 30, $noir);  // affichage d'une ellipse
imagerectangle($image, 150, 200, 180, 250, $noir); // affichage d'un rectangle
$points = array(10,10,50,80,80,40);
imagepolygon($image, $points, 3, $noir);  // affichage d'un polygone
imagecolortransparent($image, $orange);  // aspet transparent de la couleur orange
imagepng($image);  // affichage de l'image
?>