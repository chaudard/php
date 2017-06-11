<?php
$myRegEx = "#^http://[a-z0-9._/?=&-]+$#i";
$myLienCliquable = "<a href=\"$0\">$0</a>";
//$myURL = "http://www.cover3d.com";
//$myURL = "http://www.siteduzero.com/images/super_image2.jpg";
$myURL = "http://www.siteduzero.com/index.php?page=3&skin=blue";
$myURL = preg_replace($myRegEx, $myLienCliquable, $myURL);
echo $myURL;
?>