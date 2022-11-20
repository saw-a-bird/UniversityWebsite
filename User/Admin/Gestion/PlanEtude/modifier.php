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

    <title><?= $authName ?> - Modifier plan d'etude </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/secondary_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
</head>
<body>
    <?php
        $message = "";
        if (isset($_GET["id"])) {
            require_once(ROOT."/Classes/Database/PlanEtudeDB.php");
            $planEtudeDB = new PlanEtudeDB();
            $old_plan_id = $_GET["id"];
            $old_plan =  $planEtudeDB->get($old_plan_id);

            if (isset($_POST["confirm_btn"])) {
                if (isset($_POST["dateDebut"]) && isset($_POST["dateFin"])) {
                    $old_plan["dateDebut"] = $_POST["dateDebut"];
                    $old_plan["dateFin"] = $_POST["dateFin"];
                    $planEtudeDB->update($old_plan_id,  $_POST["dateDebut"], $_POST["dateFin"]);

                    $message = "<p class = 'green_alert'>La plan d'etude est modifié avec succes.</p>";
                } else {
                    $message = "<p class = 'red_alert'>La formulaire est erroné</p>";
                }
            }
        } else {
            header("location: index.php");
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
                <h1 class = "inscr_form_title"> Modifier plan d'etude: </h1>

                <?= $message ?>

                <label for="parcours" class="lab_form"> Parcours :</label>
                <select id="parcours" class="drop_form" name="parcours" disabled>
                    <?php
                        echo "<option>".$old_plan["parcoursNom"]."</option>";
                    ?>
                </select>

                <label for="dateDebut" class="lab_form"> Date debut :</label>
                <input type="date" name="dateDebut" id="lab_in_date"  value = "<?= $old_plan["dateDebut"] ?>" required>
                
                <label for="dateFin" class="lab_form"> Date fin :</label>
                <input type="date" name="dateFin" id="lab_in_date" value = "<?= $old_plan["dateFin"] ?>" required>
            
                <br>
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
