<!DOCTYPE html>
<html lang = "fr">
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Acceuil</title>
        <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
        <link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css" />
		<meta name="viewport"  content="width=max-device-width, initial-scale=1" />
    </head>
<?php
    session_start();

    require_once('connexiondb.php');

$req = $objPdo->prepare('SELECT * FROM news WHERE idtheme=:id');
$req->execute(array('id'=> $_GET['id']));
$donnees=$req->fetch();

$reponse2 = $objPdo->prepare('SELECT * FROM news WHERE idtheme=?');
$reponse2->bindValue(1,$_GET['id'],PDO::PARAM_STR);
$reponse2->execute();
?>
 <body>
  <form method="post">
<nav>
    <div class="logo">
            <a href="#"><img src="mustang.jpg" alt="logo"></a>
    </div>
    <div class="menu">
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
        </ul>
    </div>
</nav>
<?php
while($donnees = $reponse2->fetch())
{
    ?>
<div>
    <article>
<?php
        echo"<h2>".$donnees['titrenews']."</h2>";
        echo"<p name=news>".$donnees['textnews']."</p>";
        echo"<p>News écrite le ".$donnees['datenews']."</p>";
?>
    </article>
</div>


<?php
echo'<br/>';
}
$reponse2->closeCursor();
?>
<br />
<input type="submit" value="retour" name="retour" class="box-button">
<?php
    if(isset($_POST['retour']))
                 header('Location: accueil.php');
?>
</body>
</html>
