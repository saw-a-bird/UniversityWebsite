<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/index.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
    <script src="/Assets/js/inscription.js"></script>
    <title>Inscription</title>
</head>
<body>
   <?php 
        session_start();
        if (isset($_SESSION["login"])) {
            header("location: /User/index.php");
        }
        
        include("config.php");

        require_once("Classes/InscriptionDB.php");
        $inscriptionDB = new InscriptionDB();
        $enabled_inscription = $inscriptionDB->getIState();

        if (isset($_POST["INSCRIPTION_CIN"])){
            $cin = $_POST["INSCRIPTION_CIN"];

            if ($enabled_inscription == 0) {
                header("Location: closed.php");
            } elseif (!is_numeric($cin)) {
                $error = "Erreur! Entrer seulement des nombres!";
            } elseif (strlen((string)$cin) != 8) {
                $error = "Erreur! La longeur de CIN doit être 8 digits!";
            } else {
                require_once("Classes/UtilisateurDB.php");
                $utilisateurDB = new UtilisateurDB();
            
                if ($utilisateurDB->exists($cin) == true) {
                    $error = "Erreur! Cette CIN déja inscrit auparavant!";
                } else {
                    if ($inscriptionDB->exists($cin)) {
                        $_SESSION["INSCRIPTION_CIN"] = $cin;
                        header("Location: form.php");
                    } else {
                        $error = "Cet CIN n'existe pas dans la liste d'inscriptions.";
                    }

                }

                $utilisateurDB = null;
            }
        }

    ?>

    <!--logo and name--> 
    <div>
        <img src="/Assets/imgs/LOGO.png" alt="LOGO" id="logo">
        <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>

    <!--the form and title--> 
    <div>
        <p id="bienvenue">BIENVENUE</p>
        <p id="title_2">Presenter votre CIN pour incrire </p>
        <form action="" method="post">
            <?php if ($enabled_inscription == 0) {
                echo "<input maxlength='8' id='cin' type='text' name='INSCRIPTION_CIN' placeholder='L&lsquo;inscription est fermée.' disabled />";        
            } else {
                echo"<input maxlength='8' id='cin' type='text' name='INSCRIPTION_CIN' placeholder='CIN' />";
            }
            ?>


            <?php 
                if (isset($error)) {
                    echo "<p id = 'error_message'> $error </p>";
                }
            ?>
            
        </form>
        <div class = "alt_connect">
            <p>
                <span id="question_conn">Déja inscrit? Appuier ici pour </span><a href="/login.php" id="link_conn"> se connecter.</a>
            </p>
            <p>
                <span id="question_conn">Le lien de confirmation ne vous est pas parvenu? Appuier ici pour <a href="/comfirmation_again.php" id="link_conn"> pour la reenvoyer.</a></span>
            </p>
        </div>
    </div>

    <!--background img--> 
    <img src="/Assets/imgs/p_progresse.png" alt="person" id="b_img">
</body>
</html>