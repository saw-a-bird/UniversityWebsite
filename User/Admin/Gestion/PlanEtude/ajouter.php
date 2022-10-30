<!--maaneha fyha (CIN, nomprenom less9yn, Role)
     button tee l'addition excel Import Excel table Ajouter Inscription-->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        $securityRole = 2;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Ajouter un plan d'etude </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/secondary_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
</head>
<body>
    <?php
        $message = "";
        require_once(ROOT."/Classes/ParcoursDB.php");
        $parcoursDB = new ParcoursDB();
        $parcoursAll = $parcoursDB->getAllByDepID($user["departmentID"]);
        $parcoursDB = null;
        
        if (isset($_POST["confirm_btn"])) {
            if (isset($_POST["parcours"]) && isset($_POST["date_deb"]) && isset($_POST["date_fin"])) {
                
                $parcoursID = $_POST["parcours"];
                if ($parcoursID >= 0 && $parcoursID < count($parcoursAll)) {
                    $message = "<p class = 'red_alert'>Erreur! Cette parcours n'existe pas.</p>";
                } else {
                    require_once(ROOT."/Classes/PlanEtudeDB.php");
                    $planEtudeDB = new PlanEtudeDB();
                    $planEtudeDB->insert($parcoursID, $_POST["date_deb"], $_POST["date_fin"]);
                    $message = "<p class = 'green_alert'>La plan d'etude est ajouté avec succes.</p>";
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
                <h1 class = "inscr_form_title"> Ajouter un plan d'etude: </h1>

                <?= $message ?>

                <label for="parcours" class="lab_form"> Parcours :</label>
                <select id="parcours" class="drop_form" name="parcours">
                    <?php
                        require_once(ROOT."/Classes/ParcoursDB.php");
                        $parcoursDB = new ParcoursDB();
                        foreach ($parcoursDB->getAll($user["departmentID"]) as $row) {
                            echo "<option value='".$row["id"]."'>".$row["parcoursNom"]."</option>";
                        }
                    ?>
                </select>

                <label for="date_deb" class="lab_form"> Date debut :</label>
                <input type="date" name="date_deb" id="lab_in_date" required>
                
                <label for="date_fin" class="lab_form"> Date fin :</label>
                <input type="date" name="date_fin" id="lab_in_date" required>
            
                <br>
                <div class = "form_btns">
                    <input type="submit" value="Ajouter" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "index.php" class = "go_back"> Retourner </a> <a href = "#">Importer un Excel</a>
                </div>
            </div>
          </form>
      </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
