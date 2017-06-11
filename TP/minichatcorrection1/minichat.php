<?php
setcookie('pseudo');
$_COOKIE['pseudo']=(string)$_COOKIE['pseudo'];
setcookie('valid');
$_COOKIE['valid']=(int)$_COOKIE['valid'];
try
{
    $bdd= new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','root',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e){
        die('Erreur :'.$e->getMessage());
}
$req=$bdd->query('SELECT id,pseudo,message, DATE_FORMAT(date, \'%d/%m/%Y %Hh%imin%ss\')AS date FROM minichat ORDER BY date DESC LIMIT 0,5');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Minichat</title>
    </head>
    <body>
        <div>
            <form method="post" action="minichat_post.php">
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_COOKIE['pseudo'])){echo $_COOKIE['pseudo'];}else{}?>"/><br/>
                <label for="message">Message :</label>
                <textarea name="message" id="message"></textarea><br/>
                <input type="submit" value="Poster"/>
            </form>
            <?php
            if ($_COOKIE['valid']=0)
            {
                echo 'Rensignez un pseudo et un message !';
            }
            ?>
        </div>
        <div>
            <h3>Chat en direct</h3>
            <?php
            while($donnees=$req->fetch()) {
                ?>
                <p>
                    [ <?php echo htmlspecialchars($donnees['date']); ?>
                    <strong><?php echo htmlspecialchars($donnees['pseudo']); ?></strong>
                    <?php echo htmlspecialchars($donnees['message']); ?>
                </p>
                <?php
            }
            $req->closeCursor();
            ?>
        </div>
    </body>
</html>
