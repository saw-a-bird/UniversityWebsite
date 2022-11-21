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
        
        if (isset($_GET["numero"])) {
            $numero = $_GET["numero"];

            require_once(ROOT."/Classes/Database/SessionDB.php");
            $sessionDB = new SessionDB();
            $session = $sessionDB->get($numero);
            $semestre = $session["semestre"];
            $anne = $session["anne"];

            $message = "";

            if (isset($_POST["confirm_btn"])) {
                if (isset($_POST["anne"]) && isset($_POST["semestre"])) {
                    $semestre = $_POST["semestre"];
                    $anne = $_POST["anne"];

                    if ( $session["anne"] != $anne || $session["semestre"] != $semestre) {
                        if ($semestre < 1 || $semestre > 2) {
                            $message = "<p class = 'red_alert'>Erreur! La semestre ($semestre) n'a pas de sens.</p>";
                        } elseif (!is_numeric($anne)) {
                            $message = "Erreur! L'anne doit étre seulement d'un nombre!";
                        } else {
                            require_once(ROOT."/Classes/Database/SessionDB.php");
                            $sessionDB = new SessionDB();

                            $sessionExists = $sessionDB->exists($semestre, $anne);
                            if (!empty($sessionExists)) {
                                $message = "<p class = 'red_alert'>Erreur! Il existe déja une autre session avec ID #".$sessionExists["numero"]." pour (anne: $anne, semestre: $semestre)</p>";
                            } else if ($sessionDB->countByAnne($anne)["c"] >= 2) {
                                $message = "<p class = 'red_alert'>Erreur! Il existe déja deux sessions dans cet anné.</p>";
                            } else {
                                $sessionDB->update($numero, $semestre, $anne);
                                $message = "<p class = 'green_alert'>La session est modifié avec succes.</p>";
                            }
                        }
                    } else {
                        $message = "<p class = 'green_alert'>Aucune modification a affecté.</p>";
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
                <h1 class = "inscr_form_title"> Modifier session: </h1>
                <?= $message ?>

                <label for="semestre" class="lab_form"> Semestre :</label>
                <select id="semestre" class="drop_form" name="semestre">
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                </select>

                <script>
                    var semestre = <?= $semestre ?>;
                    const semestreSelect = document.getElementById('semestre');
                    semestreSelect.options[semestre+1].selected = true;
                </script>

                <label for="anne" class="lab_form"> Anne :</label>
                <input type="number" class="lab_in_txt" name = "anne" value = "<?= $anne ?>" required>
            
                <br>
                <div class = "form_btns">
                    <input type="submit" value="Créer" id="Confirmer" name="confirm_btn" onclick="return confirm('Confirmer?');">
                    <span> <a href = "index.php" class = "go_back"> Retourner </a> <span>
                </div>
            </div>
          </form>
      </div>
      
  
      <!--the img-->
      <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">
  
  </body>
  </html>
