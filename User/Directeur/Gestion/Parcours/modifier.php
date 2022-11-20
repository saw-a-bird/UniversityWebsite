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

    <title><?= $authName ?> - Modifier parcours</title>
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
        if (isset($_GET["id"])) {
            require_once(ROOT."/Classes/Database/ParcoursDB.php");
            $parcoursDB = new ParcoursDB();
            $old_parcours_id = $_GET["id"];
            $old_parcours =  $parcoursDB->get($old_parcours_id);
            
            if (isset($_POST["confirm_btn"])) {
                if (isset($_POST["nom"]) && isset($_POST["filiere"])) {
                    $parcoursNom = $_POST["nom"]; $parcoursFiliere = $_POST["filiere"];
                    if ($parcoursNom != $old_parcours["nom"] || $parcoursFiliere != $old_parcours["filiere"]) {
                        if ($parcoursNom != $old_parcours["nom"] && $parcoursDB->nomExists($parcoursNom) == true) {
                            $message = "<p class = 'red_alert'>Erreur! Cette nom de parcours existe déja dans la base de données.</p>";
                        } else {
                            $parcoursDB->update($old_parcours_id, $parcoursNom, $parcoursFiliere);
                            $old_parcours["nom"] = $parcoursNom;
                            $old_parcours["filiere"] = $parcoursFiliere;
                            $message = "<p class = 'green_alert'>La parcours est modifié avec succes.</p>";
                        }
                    }
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
                <h1 class = "inscr_form_title"> Modifier parcours: </h1>
                <?= $message ?>

                <label for="nom" class="lab_form"> Nom :</label>
                <input type="text" class="lab_in_txt" name = "nom" value = "<?= $old_parcours["nom"] ?>" required>

                <label for="filiere" class="lab_form"> Filiere :</label>
                <input type="text" class="lab_in_txt" name = "filiere" value = "<?= $old_parcours["filiere"] ?>" required>
                
                <label for="department" class="lab_form"> Department :</label>
                <select class="drop_form" name="department" id = "dep_form" disabled>
                    <?php
                         require_once(ROOT."/Classes/Database/DepartmentDB.php");
                        $departmentDB = new DepartmentDB();
                        foreach ($departmentDB->getAll() as $row) {
                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                        }
                    ?>
                </select>

                <script>
                    var dep = <?= $old_parcours["departmentID"] ?>;
                    const selectBoxDep = document.getElementById('dep_form');
                    selectBoxDep.options[dep-1].selected = true;
                </script>
                <br />
                <div class = "form_btns">
                    <input type="submit" value="Modifier" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "index.php" class = "go_back"> Retourner </a>
                </div>
            </div>
        </form>
      </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
