<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion</title>
    <link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
    <link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css" />
	<meta name="viewport"  content="width=max-device-width, initial-scale=1" />
</head>
<body>
<?php
require_once('connexiondb.php');
session_start();
if(isset($_POST['inscrire']))
{
    header('Location: inscription.php');
}
if (isset($_POST['connexion'])){
  $username = $_POST['adressemail'];
  $password = $_POST['mdp'];
  $result = $objPdo->query("SELECT * FROM redacteur WHERE adressemail=\"$username\" AND motdepasse =\"$password\"");
  $rows = $result->rowCount($result);
  $row = $result->fetch();
  if($rows==1) {
      $_SESSION['adressemail'] = $username;
      $_SESSION['idredacteur'] = $row['idredacteur'];
      header("Location: accueil.php");
  }else{
    $message = "L'adresse mail ou le mot de passe est incorrect.";
  }
}
?>
<form class="box" action="" method="post" name="login">
<h1 class="box-title">Connexion</h1>
<nav>
    <div class="logo">
  		  <a href="accueil.php"><img src="mustang.jpg" alt="logo"></a>
    </div>
    <div class="menu">
      <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="inscription.php">Inscription</a></li>
      </ul>
    </div>
  </nav>
  <label for="adressemail">Adresse mail :</label>
        <input type="text" class="box-input" name="adressemail" placeholder="Adresse Mail">
        <br />
        <br />
    <label for="mdp">Mot de passe :</label>
        <input type="password" class="box-input" name="mdp" placeholder="Mot de passe">
        <br />
        <br />
        <input type="submit" value="Connexion " name="connexion" class="box-button">
        <input type="submit" value="S'inscrire " name="inscrire" class="box-button">
<!--<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p> -->
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php  }?>
</form>
</body>
</html>