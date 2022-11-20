<!--maaneha fyha (CIN, nomprenom less9yn, Role)
     button tee l'addition excel Import Excel table Ajouter Inscription-->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Ajouter un classe</title>
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
            if (isset($_POST["parcours"]) && isset($_POST["numero"])) {
                require_once(ROOT."/Classes/Database/ClasseDB.php");
                $classeDB = new ClasseDB();

                require_once(ROOT."/Classes/Database/GlobalDB.php");
                $globalDB = new GlobalDB();
                $currentSession = $globalDB->getSession();
                if (!empty($currentSession)) {
                    $classeDB->insert($_POST["parcours"], $_POST["numero"], $currentSession["anne"]);
                    $message = "<p class = 'green_alert'>La classe est ajouté avec succes.</p>"; 
                } else {
                    $message = "<p class = 'red_alert'>Veuillez à selectionner un session avant de créer des classes!</p>";
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
                <h1 class = "inscr_form_title"> Ajouter un classe: </h1>

                <?= $message ?>

                <label for="parcours" class="lab_form"> Parcours :</label>
                <select class="drop_form" name="parcours" id = "dep_form" required>
                    <?php
                         require_once(ROOT."/Classes/Database/ParcoursDB.php");
                        $parcoursDB = new ParcoursDB();
                        foreach ($parcoursDB->getAllByDepartment($user["departmentID"]) as $row) {
                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                        }
                    ?>
                </select>


                <label for="numero" class="lab_form"> Numero :</label>
                <input type="number" class="lab_in_txt"  name = "numero" required>

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
