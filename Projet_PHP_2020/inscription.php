<!DOCTYPE html>
<html lang = "fr">
	<head>
  		<meta charset="UTF-8" />
  		<title>Inscription</title>
			<link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
			<link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css" />
            <meta name="viewport"  content="width=max-device-width, initial-scale=1" />
    </head>
    <body>

   <?php
    error_reporting(E_ALL ^ E_NOTICE);
   require_once('connexiondb.php');
   $erreur=array();
   session_start();
// Vérification de la validité des informations

if(isset($_POST['ajouter'])){

  if(!isset($_POST['nom']) or strlen(trim($_POST['nom']))==0)
  {
      $erreur['nom'] = 'saisie obligatoire du nom';
  }
  else
  {
        $nom = htmlspecialchars( $_POST['nom']);
  }
  if(!isset($_POST['prenom']) or strlen(trim($_POST['prenom']))==0)
  {
      $erreur['prenom'] = 'saisie obligatoire du prenom';
  }
  else
  {
        $prenom =  htmlspecialchars($_POST['prenom']); 
  }
  if(filter_var(trim($_POST['adressemail']), FILTER_VALIDATE_EMAIL))
  {
    $verif = $objPdo->prepare("SELECT * FROM redacteur WHERE adressemail=?");
    $verif->execute(array($_POST['adressemail'])); 
    $mail_verif = $verif->rowCount();
      if($mail_verif == 0)
      {
        // email n'existe pas
        $mail = $_POST['adressemail'];
      }
      else{
     $erreur['adressemail'] = 'cette adresse mail est utilisé par un autre compte'; 
      }  
  }
  else 
  {
    $erreur['adressemail'] = 'adresse e-mail non valide'; 
  }
  if(strlen(trim($_POST['mdp']))==0 || strlen(trim($_POST['mdp2']))==0)
  {
      $erreur['mdp'] = 'saisie obligatoire du mot de passe';
  }
  else if(strlen(trim($_POST['mdp'])) == strlen(trim($_POST['mdp2'])))
  {
        $mdp =  htmlspecialchars($_POST['mdp']); 
  }
if(count($erreur)==0)
{
$req = $objPdo->prepare('INSERT INTO redacteur(nom, prenom, adressemail, motdepasse) VALUES(:nom, :prenom, :adressemail, :motdepasse)');
$req->execute(array(
    'nom' => $nom,
    'prenom' => $prenom,
    'adressemail' => $mail,
    'motdepasse' => $mdp));
    echo'Votre incription est terminée !';
}

}

   ?>
   <form id="add" name="add" action="" method="post">
   <h1 class="box-title">Inscription</h1>
     <nav>
       <div class="logo">
     		  <a href="accueil.php"><img src="mustang.jpg" alt="logo"></a>
       </div>
       <div class="menu">
         <ul>
           <li><a href="accueil.php">Accueil</a></li>
           <li><a href="login.php">Connexion</a></li>
         </ul>
       </div>
     </nav>

     <label for="nom">Nom :</label>
        <input type="text" class="box-input" name="nom" placeholder="nom"size = "30px">
        <br />
        <span class="erreur"><?php echo $erreur['nom']?></span>
        <br />
    <label for="prenom">Prénom :</label>
        <input type="text" class="box-input" name="prenom" placeholder="Prénom"size = "30px">
        <br />
        <span class="erreur"><?php echo $erreur['prenom']?></span>
        <br />
        <label for="adressemail">Adresse mail :</label>
        <input type="text" class="box-input" name="adressemail" placeholder="Adresse Mail"size = "30px">
        <br />
        <span class="erreur"><?php echo $erreur['adressemail']?></span>
        <br />
        <label for="mdp">Mot de passe :</label>
        <input type="password" class="box-input" name="mdp" placeholder="Mot de passe"size = "30px">
        <br />
        <span class="erreur"><?php echo $erreur['mdp']?></span>
        <br />
        <label for="mdp2">Confirmer le mot de passe :</label>
        <input type="password" class="box-input" name="mdp2" placeholder="Confirmation du mot de passe"size = "30px">
        <br />
        <span class="erreur"><?php echo $erreur['mdp']?></span>
        <br />
        <input type="submit" value="ajouter " name="ajouter" class="box-button">
   </form>
</body>
</html>
