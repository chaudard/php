<?php
$phraseS = 'c \'est en forgeant qu\'on devient forgeron.';
$len = strlen($phraseS);
echo $phraseS;
echo '<br/>La phrase ci-dessus contient '.$len.' caractères.';
function auCarre($arete)
{return $arete*$arete;}
$arete = 5;
echo '<br/>le carré de '.$arete.' est '.auCarre($arete);
?>