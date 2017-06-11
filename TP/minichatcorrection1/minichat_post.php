<?php

try
{
    $bdd=new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','root',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Erreur :'.$e->getMessage());
}
$_POST['pseudo']=(string)$_POST['pseudo'];
$_POST['message']=(string)$_POST['message'];
if(isset($_POST['pseudo']) AND isset($_POST['message']))
{
    $req=$bdd->prepare('INSERT INTO minichat(pseudo,message,date) VALUES (:pseudo, :message, NOW())');
    $req->execute(array(
        ':pseudo'=> $_POST['pseudo'],
        ':message'=> $_POST['message']
    ));

    $valid=1;
}
else
{
    echo 'Renseignez votre pseudo et le message à envoyer';
    $valid=0;
}
$_POST['pseudo']=(string)$_POST['pseudo'];
$pseudo = $_POST['pseudo'];
$_COOKIE['valid']=(int)$valid;
setcookie('pseudo',$pseudo, time()+3600, null, null, false, true);
setcookie('valid', $valid, time()+3600, null, null, false, true);

header('Location: minichat.php');
?>