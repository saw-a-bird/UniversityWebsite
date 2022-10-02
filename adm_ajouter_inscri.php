<!--maaneha fyha (CIN, nomprenom less9yn, Role)
     button tee l'addition excel Import Excel table Ajouter Inscription-->
     <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Inscription </title>
    <link rel="stylesheet" href="Assets/css/ajouter_iscri.css">
    <link rel="stylesheet" href="Assets/css/general.css">
</head>
<body>
    <?php
        session_start();
        include("Pipes/get_login.php");
        include("config.php");

        $message = "";
        if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == 0) {
            if (isset($_POST["confirm_btn"])) {
                if (isset($_POST["nomprenom"], $_POST["cin"], $_POST["role"]) && is_numeric($_POST["cin"])) {
                    require_once("Classes/AdminDB.php");
                    $adminDB = new AdminDB();
                    $adminDB->addToList($_POST["cin"], $_POST["nomprenom"], $_POST["role"]);
                    
                    $message = "<p class = 'green_alert'>La CIN est ajouté avec succes.</p>";
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
        <img src="Assets/imgs/LOGO.png" alt="LOGO" id="logo">
        <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>
    <!--form-->
    <div id="container">
        <form action="" method="post" id="f_first">
            <div>
                <h1 class = "inscr_form_title"> Ajouter Inscription: </h1>

                <?= $message ?>

                <label for="prenom" class="lab_form"> Nom & Prenom :</label>
                <input type="text" class="lab_in_txt" name = "nomprenom" required>

                <label for="prenom" class="lab_form"> CIN </label>
                <input type="text" class="lab_in_txt" name = "cin" required>
                
                <label for="role" class="lab_form"> Role :</label>
                <select id="role" class="drop_form" name="role">
                    <option value="1">Enseignant</option>
                    <option value="2">Parent</option>
                    <option value="3" selected>Etudiant</option>
                </select><br>
                <div class = "form_btns">
                    <input type="submit" value="Ajouter" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "adm_inscription.php" class = "go_back"> Retourner </a> <a href = "#">Importer un Excel</a>


                </div>
            </div>
          </form>
          
      </div>
      
  
      <!--the img-->
      <img src="Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
