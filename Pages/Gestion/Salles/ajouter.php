<!--maaneha fyha (CIN, nomprenom less9yn, Role)
     button tee l'addition excel Import Excel table Ajouter Inscription-->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        $securityRole = 0;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Ajouter un salle</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/secondary_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
</head>
<body>
    <?php
        $message = "";
        // require_once(ROOT."/Classes/Database/ParcoursDB.php");
        // $parcoursDB = new ParcoursDB();
        // $parcoursAll = $parcoursDB->getAllByDepID($user["departmentID"]);
        // $parcoursDB = null;
        
        if (isset($_POST["confirm_btn"])) {
            if (isset($_POST["nom"])) {
                $salleNom = $_POST["nom"];
                require_once(ROOT."/Classes/Database/SalleDB.php");
                $salleDB = new SalleDB();
                $salleExist = $salleDB->exists($salleNom);

                if ($salleExist == true) {
                    $message = "<p class = 'red_alert'>Erreur! Cette nom de salle existe déja dans la base de données.</p>";
                } else {
                    $salleDB->insert($salleNom);
                    $message = "<p class = 'green_alert'>La salle est ajouté avec succes.</p>";
                }
            } else {
                $message = "<p class = 'red_alert'>La formulaire est erroné</p>";
            }
        }
    ?>
         <!--logo and name--> 
    <div>
        <img src="/Assets/imgs/LOGO.png" alt="LOGO" id="logo">
        <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>
    <!--form-->
    <div id="container" style = "top: 15%;">
        <form action="" method="post" id="f_first">
            <div>
                <h1 class = "inscr_form_title"> Ajouter un salle: </h1>

                <?= $message ?>

                <label for="nom" class="lab_form"> Nom :</label>
                <input type="text" class="lab_in_txt"  name = "nom" required>

                <br />
                <div class = "form_btns">
                    <input type="submit" value="Ajouter" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "index.php" class = "go_back"> Retourner </a>
                </div>
            </div>
        </form>
      </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
