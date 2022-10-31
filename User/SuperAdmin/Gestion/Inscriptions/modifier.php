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

    <title><?= $authName ?> - Modifier Inscription </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/secondary_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
</head>
<body>
    <?php
        require_once(ROOT."/Classes/InscriptionDB.php");
        $inscriptionDB = new InscriptionDB();
        $inscription = $inscriptionDB->get($_GET["id"]);

        $message = "";
        
        if (isset($_POST["confirm_btn"])) {
            if (isset($_POST["nomprenom"]) && (isset($_POST["cin"]) && is_numeric($_POST["cin"])) && isset($_POST["role"]) && isset($_POST["department"])) {

                $new_cin = $_POST["cin"];
                $post_dep = $_POST["department"];
                if (strlen((string)$new_cin) != 8) {
                    $message = "<p class = 'red_alert'>Erreur! La longeur de CIN doit être 8 digits!</p>";
                } elseif ($post_dep < 1 && $post_dep > 4) {
                    $message = "<p class = 'red_alert'>Erreur! Cette department n'existe pas.</p>";
                } else {
                    if ($new_cin != $inscription["cin"] && $inscriptionDB->exists($new_cin)) {
                        $message = "<p class = 'red_alert'>Cette CIN déja existe dans la liste d'inscriptions</p>";
                    } else {
                        require_once(ROOT."/Classes/UtilisateurDB.php");
                        $utilisateurDB = new UtilisateurDB();

                        $new_role = $_POST["role"];
                        if ($new_role != $inscription["role"] && $utilisateurDB->exists($new_cin)) {
                            $message = "<p class = 'red_alert'>Désolé, un utilisateur est déja créé avec cet CIN. Il faut le modifier sa compte directement.</p>";
                        } else {
                            $inscriptionDB->update($inscription["cin"], $new_cin, $_POST["nomprenom"], $post_dep, $new_role);
                            $message = "<p class = 'green_alert'>Le record est modifié avec succes.</p>";
                            $inscription["cin"] = $new_cin;
                            $inscription["role"] = $new_role;
                            // header("location: modifier.php?id=".$new_cin."&m=1");
                        }
                    }
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
                <h1 class = "inscr_form_title"> Modifier Inscription: </h1>

                <?= $message ?>

                <label for="prenom" class="lab_form"> Nom & Prenom :</label>
                <input type="text" class="lab_in_txt" name = "nomprenom" value = "<?= $inscription["nomprenom"]?>" required>

                <label for="prenom" class="lab_form"> CIN </label>
                <input type="text" class="lab_in_txt" name = "cin" value = "<?= $inscription["cin"]?>" maxlength='8' required>
                
                <label for="department" class="lab_form"> Department :</label>
                <select id="department" class="drop_form" name="department">
                    <?php
                        require_once(ROOT."/Classes/DepartmentDB.php");
                        $departmentDB = new DepartmentDB();
                        foreach ($departmentDB->getAll() as $row) {
                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                        }
                    ?>
                </select>

                <label for="role" class="lab_form"> Role :</label>
                <select id="role" class="drop_form" name="role">
                <?php
                        require_once(ROOT."/Classes/Roles.php");
                        foreach (Roles::getAll() as $id => $name) {
                            echo "<option value='$id'>$name</option>";
                        }
                    ?>
                </select><br>

                <script>

                    var depValue = <?= $inscription["departmentID"]?>;
                    var depInput = document.getElementById("department");
                    depInput.options[depValue-1].selected = true;

                    var roleValue = <?= $inscription["role"]?>;
                    var roleInput = document.getElementById("role");
                    roleInput.options[roleValue-1].selected = true;
                </script>
                
                <div class = "form_btns">
                    <input type="submit" value="Modifier" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "index.php" class = "go_back"> Retourner </a> <a href = "#">Importer un Excel</a>
                </div>
            </div>
          </form>
      </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
