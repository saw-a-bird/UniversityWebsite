<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'inscription est fermée</title>
    <link rel="stylesheet" href="/Assets/css/closed.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
</head>
<body>
    <?php 
      include("config.php");

      require_once("Classes/Database/GlobalDB.php");
      $globalDB = new GlobalDB();

      if ($globalDB->getInscription() == 1) {
          header("Location: /index.php");
      }
    ?>
      <!--logo and name--> 
      <div>
        <img src="/Assets/imgs/LOGO.png" alt="LOGO" id="logo">
    <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>
    <!--Content-->
    <div>
        <p id="titre_close">Désolé, le site n'est pas encore disponible!</p>
        <p id="s_titre_close">Returner dans le 28 aôut.</p>
    </div>
    <img src="/Assets/imgs/woman_p_unavilable.png" alt="woman" id="img_close">
</body>
</html>