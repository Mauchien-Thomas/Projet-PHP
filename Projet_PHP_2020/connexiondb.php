<meta charset="utf-8" />
<?php
try {
    $objPdo = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=mauchien3u_ProjetPhp',  'mauchien3u_appli', '31807313' ); 
} catch(Exception $exception ) { 
    die($exception->getMessage());
}
?>

