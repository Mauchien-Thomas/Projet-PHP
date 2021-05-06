<!DOCTYPE html>
<html lang = "fr">
	<head>
  		<meta charset="UTF-8" />
  		<title>Ajouter news</title>
			<link rel="stylesheet" media="screen and (min-width:721px)" href="style.css" />
			<link rel="stylesheet" media="screen and (max-width:720px)" href="mobile.css" />
            <meta name="viewport"  content="width=max-device-width, initial-scale=1" />
    </head>
    <body>
    <form id="add" name="add" action="" method="post">
   <h1 class="box-title">Ajouter une newsletter</h1>
     <nav>
       <div class="logo">
     		  <a href="accueil.php"><img src="mustang.jpg" alt="logo"></a>
       </div>
       <div class="menu">
         <ul>
           <li><a href="accueil.php">Accueil</a></li>
           <li><a href="login.php">Connexion</a></li>
           <li><a href="inscription.php">Inscription</a></li>
         </ul>
       </div>
     </nav>
     <?php
    error_reporting(E_ALL ^ E_NOTICE);
    require_once('connexiondb.php');
    session_start();
    $erreur=array();

    if(isset($_POST['valider'])){

      if(isset($_POST['liste']))
      {
        $choix_theme = ceil($_POST['liste']);
        if($choix_theme == 0)
          $erreur['liste'] = 'saisie obligatoire du thème';
        else if($choix_theme == 1)
            $choix_theme = 1;
        else if($choix_theme == 2)
            $choix_theme = 2;
        else if($choix_theme == 3)
            $choix_theme = 3;
        else if($choix_theme == 4)
            $choix_theme = 4;
      }
      else
      {
            $choix_theme = $_POST[$output];
      }
      
      if(!isset($_POST['titre']) or strlen(trim($_POST['titre']))==0)
      {
          $erreur['titre'] = 'saisie obligatoire du titre !';
      }
      else
      {
            $titre = htmlspecialchars($_POST['titre']);
      }
      if(!isset($_POST['newsletters']) or strlen(trim($_POST['newsletters']))==0)
      {
          $erreur['newsletters'] = 'saisie obligatoire de la news !';
      }
      else
      {
            $newsletters = htmlspecialchars($_POST['newsletters']);
      }
      if (count($erreur)==0)
      {
   
        $req = 'INSERT INTO news(idtheme, titrenews, datenews, textnews, idredacteur) VALUES(:theme, :titrenews, :datenews, :textenews, :idredacteur)';
   
        $insert = $objPdo->prepare($req);
        $insert->execute(array( 
         'theme'=> $choix_theme,
         'titrenews'=>$_POST['titre'], 
         'datenews'=>date('Y-m-d'),
         'textenews'=>$_POST['newsletters'],
         'idredacteur'=>$_SESSION['idredacteur']));
         header('Location: accueil.php');
   
      }
    }
    try{
    $theme = $objPdo->prepare("SELECT * FROM theme");
    $theme->execute(); 
    $liste_theme = $theme->fetchAll();
    }
    catch(Exception $ex){
      echo($ex -> getMessage());
    }
   
    ?>

    <label>Thème :</label>
    <select name=liste> 
           <option value=0></option>
           <option value=1>Cinema</option>
           <option value=2>Jeux-video</option>
           <option value=3>musique</option>
           <option value=4>animations japonaises</option>
           <br\>
    </select>
    <br/>
    <span class="erreur"><?php echo $erreur['liste']?></span>
    <br/>
    <br/>
        <label>Titre de la news :</label>
        <input type="text" class="box-input" name="titre" placeholder="titre de la news"size = "30px">
    <br/>
    
        <span class="erreur"><?php echo $erreur['titre']?></span>
    <br/>
    <br/>
    <textarea name="newsletters" rows="20" cols="200"> </textarea>
    <br/>
          <span class="erreur"><?php echo $erreur['newsletters']?></span>
    <br/>
    <input type="submit" value="valider" name="valider" class="box-button">
    </body>
</html>
