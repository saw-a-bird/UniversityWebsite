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

    <title><?= $authName ?> - Ajouter un matiere </title>
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
        if (isset($_POST["confirm_btn"]) && isset($_POST["plan_id"])) {
            $plan_id = $_POST["plan_id"];
            if (isset($_POST["unite"]) && isset($_POST["nom"]) && isset($_POST["coeff"]) && isset($_POST["credit"]) && isset($_POST["heursCours"]) && isset($_POST["heursTP"])) {
                
                require_once(ROOT."/Classes/Database/MatiereDB.php");
                $matiereDB = new MatiereDB();
                $matiereDB->insert(
                    $_POST["nom"],
                    $_POST["coeff"],
                    $_POST["credit"],
                    $_POST["heursCours"],
                    $_POST["heursTP"],
                    $_POST["unite"]
                );
                $message = "<p class = 'green_alert'>La unité est ajouté avec succes.</p>";
            } else {
                $message = "<p class = 'red_alert'>La formulaire est erroné</p>";
            }
        } else if (isset($_GET["plan_id"])) {
            $plan_id = $_GET["plan_id"];
        } else {
            header("location: afficher.php");
        }
    ?>
         <!--logo and name--> 
    <div>
        <img src="/Assets/imgs/LOGO.png" alt="LOGO" id="logo">
        <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>
    <!--form-->
    <div id="container" style = "top: 5%;">
        <form action="" method="post" id="f_first">
            <div>
                <h1 class = "inscr_form_title"> Ajouter un matiere: </h1>

                <?= $message ?>
                
                <input type="hidden" name="plan_id" value = "<?= $plan_id ?>" required>

                <label for="unite" class="lab_form"> Unite :</label>
                <select id="unite" class="drop_form" name="unite">
                <?php
                        require_once(ROOT."/Classes/Database/UniteDB.php");
                        $uniteDB = new UniteDB();
                        foreach ($uniteDB->getAll($plan_id) as $row) {
                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                        }
                    ?>
                </select>

                <label for="nom" class="lab_form"> Nom :</label>
                <input type="text" name="nom" class="lab_in_txt" required>

                <label for="coeff" class="lab_form"> Coefficient :</label>
                <input type="number" name="coeff" class="lab_in_txt" required step="0.25" value="0.00" /> 

                <label for="credit" class="lab_form"> Credit :</label>
                <input type="number" name="credit" class="lab_in_txt" required  step="0.25" value="0.00" /> 
                
                <label for="heursCours" class="lab_form"> Volume horaire de cours :</label>
                <input type="number" name="heursCours" class="lab_in_txt" required  step="0.5" value="0.0" /> 

                
                <label for="heursTP" class="lab_form"> Volume horaire de TP :</label>
                <input type="number" name="heursTP" class="lab_in_txt" required  step="0.5" value="0.0" /> 

                <div class = "form_btns">
                    <input type="submit" value="Ajouter" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "afficher.php?id=<?= $plan_id ?>" class = "go_back"> Retourner </a>
                </div>
            </div>
          </form>
      </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
