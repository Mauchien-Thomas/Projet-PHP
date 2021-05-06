<!DOCTYPE html>
<html lang = "fr">
	<head>
  		<meta charset="UTF-8" />
        <title>Acceuil</title>
        <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
        <link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css" />
		<meta name="viewport"  content="width=max-device-width, initial-scale=1" />
    </head>
    <script language="javascript">

function confirmDeconnection(){
 var confirmer=confirm("Etes vous sûre de vouloir vous déconnecter ?");
 if(!confirmer)
 {
 return false;
}
}

</script>
    <?php
        session_start();
        require_once('connexiondb.php');
       $reponse = $objPdo->query('SELECT * FROM theme');
       $reponse2 = $objPdo->query('SELECT * FROM redacteur');
        
    ?>
  <body>
  <form method="post" action="accueil.php" onSubmit="return confirmDeconnection();">

<nav>
    <div class="logo">
            <a href="#"><img src="mustang.jpg" alt="logo"></a>
    </div>
    <div class="menu">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="login.php">Connexion</a></li>
            <li><a href="inscription.php">Inscription</a></li>
        </ul>
    </div>
</nav>

<br/>

<?php

 if (isset ($_SESSION['adressemail'])){


    if (isset($_POST['deco']))
    {
      ?>
  
  
      <nav>
        <div class="logo">
                <a href="#"><img src="mustang.jpg" alt="logo"></a>
        </div>
        <div class="menu">
          <ul>
                  <li><a href="#">Accueil</a></li>
            <li><a href="login.php">Connexion</a></li>
          </ul>
        </div>
      </nav>
      <?php
      session_unset();
      session_destroy();
    }
}
    if (isset ($_SESSION['adressemail'])){
    echo"<h1>Bienvenue " .$_SESSION['adressemail']." !</h1>";
    echo"<br />";
?>
<nav>
    <div class="logo">
            <a href="#"><img src="mustang.jpg" alt="logo"></a>
    </div>
    <div class="menu">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="ajouterNews.php">Ajouter</a></li>
            <li><a href="accueil.php?"><?php  echo "<input id='deco' name='deco' type='submit' value='Deconnexion'>"; ?><a></li>
        </ul>
    </div>
</nav>
<?php


}

?>
<h2>Liste des thème :</h2>

<?php

while($donnees = $reponse->fetch())
{
?>

<table class="tableau">

  <tr>
    <td><a href="themeChoisi.php?id=<?php echo $donnees['idtheme'];?>"><?php echo $donnees['description'];?></a><br\></td>
  </tr>

</table>
<?php
}
$reponse->closeCursor();

?>
</form>
    </body>
</html>