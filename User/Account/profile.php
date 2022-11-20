<!DOCTYPE html>
<head>
    <?php
        session_start();
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title> Profile </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>
<?php
 
    include_once(ROOT."/Classes/Utilisateur.php");
    $sexe = Utilisateur::getSexeName($user["sexe"]);

    if (isset($user["departmentID"])) {
        include_once(ROOT."/Classes/Database/DepartmentDB.php");
        $departmentDB = new DepartmentDB();
        $department = $departmentDB->getNom($user["departmentID"]);
        $departmentDB = null;
    }

    //include_once(ROOT."/Classes/Roles.php");
    $role = Roles::getName($user["role"]);

    if (isset($_GET["m"])) {
        $m = $_GET["m"];
        if ($m == 1) {
            $message = "<p class = 'success_alert'>Tes informations sont modifié avec succes.</p>";
        } elseif ($m == 2) {
            $message = "<p class = 'success_alert'>Ton mot de passe est changé avec succes.</p>";
        }
    }
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "go_back"> <a href="/User/index.php">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>

</div>
   
</div>
    <div class="cd">
<div class="cadre">
    <div class="pg">
        <div class="img_container">
            <?php
                if ($user["sexe"] == 0) {
                    echo '<img src="/Assets/imgs/profile_picture_female.png">';
                } else {
                    echo '<img src="/Assets/imgs/profile_picture_male.png">';
                }
            ?>
            <div>
                <h2>Informations:</h2>
                <?= isset($message)? $message: "" ?>
            </div>
        </div>
        <div class = "flex-box">
            <div class="form_">
                <ul>
                    <li>
                    <span>Matricule:</span> <?= $user["matricule"] ?> </li>
                
                    <br>
                    <br>

                    <li>
                    <span>Nom:</span> <?= $user["nom"] ?> </li>
                
                    <br>
                    <br>
            
                    <li>
                    <span>Prenom:</span> <?= $user["prenom"] ?>
                    </li>
                    <br>
                    <br>
            
                    <li>
                    <span>Sexe:</span>  <?= $sexe ?>
                    </li>
                    <br>
                    <br>
                
                    <li> <span>Date de naissance:</span>  <?= $user["dateNaissance"] ?>

                    </li> 
                    <br>
                    <br>

                </ul>
            </div>
            <div class="verticalLine"></div>
            <div class="form_">
                <ul>
                    <li> <span>Date d'inscription:</span>  <?= $user["dateInscription"] ?> </li> 
                    <br>
                    <br>
                    <li> <span>Adresse:</span>  <?= $user["adresse"] ?> </li>
                
                    <br>
                    <br>

                    <li> <span>Role:</span> <?= $role ?></li>
                    <br>
                    <br>

                    <?php 
                        if ($user["role"] > 0) {
                            echo "<li> <span>Department:</span> ".$department." </li>
                            <br>
                            <br>";
                        }
                    ?>

                </ul>

            </div>
        </div>
        <div class = "_tool_buttons right">
            <a href = "password.php"><button class = "_btn _blue_btn" disabled> Changer mot de passe </button></a>
            <a href = "modifier.php"><button class = "_btn _yellow_btn"> Modifier informations </button></a>
        </div>
    </div>

</div>

</div>
</body>