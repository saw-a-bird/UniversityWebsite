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

    <title><?= $authName ?> - Ajouter un unite </title>
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
        if (isset($_POST["confirm_btn"]) && isset($_POST["planId"])) {
            $planId = $_POST["planId"];
            if (isset($_POST["type"]) && isset($_POST["nom"]) && isset($_POST["semestre"])) {
                
                require_once(ROOT."/Classes/Database/UniteDB.php");
                $uniteDB = new UniteDB();
                $uniteDB->insert($_POST["type"], $_POST["nom"], $_POST["semestre"], $planId);
                $message = "<p class = 'green_alert'>La unité est ajouté avec succes.</p>";
            } else {
                $message = "<p class = 'red_alert'>La formulaire est erroné</p>";
            }
        } else if (isset($_GET["planId"])) {
            $planId = $_GET["planId"];
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
                <h1 class = "inscr_form_title"> Ajouter un unité: </h1>

                <?= $message ?>
                <input type="hidden" name="planId" value = "<?= $planId ?>" required>
                
                <label for="type" class="lab_form"> Type :</label>
                <select id="type" class="drop_form" name="type">
                    <option value='Fondamentale'>Fondamentale</option>
                    <option value='Transversale'>Transversale</option>
                    <option value='Optionelle'>Optionelle</option>
                </select>

                <label for="nom" class="lab_form"> Nom :</label>
                <input type="text" name="nom" class="lab_in_txt" required>

                <label for="semestre" class="lab_form"> Semestre :</label>
                <select id="semestre" class="drop_form" name="semestre">
                    <option value='1'>S1</option>
                    <option value='2'>S2</option>
                </select>
                <br>
                <div class = "form_btns">
                    <input type="submit" value="Ajouter" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "../afficher.php?id=<?= $planId ?>" class = "go_back"> Retourner </a>
                </div>
            </div>
          </form>
      </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
