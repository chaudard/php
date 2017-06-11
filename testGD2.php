<?php

// fusion entre 2 images

header("Content-type: image/jpeg");  // pour que le script renvoie une image et non pas une page php
$source = imagecreatefrompng("logoSiteZero.png");// image source
$destination = imagecreatefromjpeg("coucherSoleil.jpg"); // image destination qui sera affichée après la fusion
// calcul de la position de la source sur la destination (placement en bas à droite)
$sourceL = imagesx($source);
$sourceH = imagesy($source);
$destinationL = imagesx($destination);
$destinationH = imagesy($destination);
$destinationX = $destinationL - $sourceL;
$destinationY = $destinationH - $sourceH;
$opacity = 60; // information de transparence
imagecopymerge($destination, $source, $destinationX, $destinationY, 0, 0, $sourceL, $sourceH, $opacity);
imagejpeg($destination);
?>