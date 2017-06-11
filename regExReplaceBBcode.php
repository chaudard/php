<?php
$myRegExSearchForBold = "#\[b\](.+)\[/b\]#isU";
$myBoldInstruction = "<strong>$1</strong>";
$myRegExSearchForItalic = "#\[i\](.+)\[/i\]#isU";
$myItalicInstruction = "<em>$1</em>";

$myText = "Je suis plus [b]fort[/b] que je parais. On m'appelle l'[i]éléphant[/i] (php).";
$myText = preg_replace($myRegExSearchForBold, $myBoldInstruction, $myText);
$myText = preg_replace($myRegExSearchForItalic, $myItalicInstruction, $myText);
echo $myText;
?>