<?php
// ici , il n'y a pas de header car le script ne crée pas l'image directement, il l'enregistre sur le disque dur

// enregistrement d'une image miniature sur le disque
$source = imagecreatefromjpeg("coucherSoleil.jpg"); // l'image dont on veur créer la miniature
$destination = imagecreatetruecolor(200, 150); // imagetruecolor pour être sûr d'avoir assez de couleurs pour créer la miniature + dimensions de la miniature
// récupérons les dimensions des images source et destination
$sourceL = imagesx($source);
$sourceH = imagesy($source);
$destinationL = imagesx($destination);
$destinationH = imagesy($destination);
// création de la miniature
imagecopyresampled($destination, $source, 0, 0, 0, 0, $destinationL, $destinationH, $sourceL, $sourceH);

// on enregistre la miniature sous le nom "miniCoucheSoleil.jpg"
imagejpeg($destination, "miniCoucherSoleil.jpg");
?>