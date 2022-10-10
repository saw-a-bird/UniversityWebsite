<!--maaneha fyha (CIN, nomprenom less9yn, Role)
     button tee l'addition excel Import Excel table Ajouter Inscription-->
     <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire - Modifier informations </title>
    <link rel="stylesheet" href="/Assets/css/secondary_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
</head>
<body>
    <?php
        session_start();
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");

        $message = "";
        if (isset($_POST["confirm_btn"])) {
            $post_nom = $_POST["nom"];
            $post_prenom = $_POST["prenom"];
            $post_adresse = $_POST["adresse"];
            $post_sexe = $_POST["sexe"];

            // check general errors
            if (!empty($post_nom) && !empty($post_prenom) && !empty($post_adresse) && ($post_sexe >= 1 && $post_sexe <= 2)) {
                require_once(ROOT."/Classes/Utilisateur.php");
                require_once(ROOT."/Classes/UtilisateurDB.php");
                $utilisateurDB = new UtilisateurDB();
                
                $utilisateur = new Utilisateur();
                $utilisateur->setCIN($user["CIN"])
                    ->setNom($post_nom)
                    ->setPrenom($post_prenom)
                    ->setAdresse($post_adresse)
                    ->setSexe($post_sexe)
                    ->setDateNaissance($_POST["date_dn"]);

                $utilisateurDB->update($utilisateur);

                header("location: /User/Account/profile.php?m=1");
            } else {
                $message = "<p class = 'red_alert'>La formulaire est erroné.</p>";
            }
        }

    ?>
         <!--logo and name--> 
    <div>
        <img src="/Assets/imgs/LOGO.png" alt="LOGO" id="logo">
        <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>
    <!--form-->
    <div id="container" style = "top: 10%;">
        <form action="" method="post" id="f_first">
            <div>
                <h1 class = "inscr_form_title"> Informations: </h1>

                <?= $message ?>

                <label for="prenom" class="lab_form"> Prenom :</label>
                <input type="text" class="lab_in_txt" name = "prenom" value = "<?= $user["prenom"]?>" required>
                
                <label for="nom" class="lab_form"> Nom :</label>
                <input type="text" class="lab_in_txt" name = "nom" value = "<?= $user["nom"]?>" required>
                
                <label for="sexe" class="lab_form"> Sexe :</label>
                <select id="sexe" class="drop_form" name="sexe">
                    <option value="1">Homme</option>
                    <option value="2">Femme</option>
                </select>

                <script>
                    var sexeValue = <?= $user["sexe"]?>;
                    var sexeInput = document.getElementById("sexe");
                    sexeInput.options[sexeValue-1].selected = true;
                </script>
                

                <label for="date_dn" class="lab_form"> Date de naissance :</label>
                <input type="date" name="date_dn" id="lab_in_date" value = "<?= $user["dateNaissance"]?>" required>

                <label for="adresse" class="lab_form"> Adresse :</label>
                <input type="text" class="lab_in_txt"  name = "adresse" value = "<?= $user["adresse"]?>" required>
                <div class = "form_btns">
                    <input type="submit" value="Modifier" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "profile.php" class = "go_back"> Retourner </a> <a href = "#">Importer un Excel</a>
                </div>
            </div>
        </form>
    </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
