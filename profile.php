<!DOCTYPE html>
<head>
<link rel="stylesheet" href="Assets/css/user.css">
<link rel="stylesheet" href="Assets/css/profil.css">
</head>
<body>
<?php
    session_start();
    include("Pipes/get_login.php");
    include("config.php");
 
    include_once("Classes/Utilisateur.php");
    $sexe = Utilisateur::getSexeName($user["sexe"]);

    if (isset($user["department"])) {
        include_once("Classes/DepartmentDB.php");
        $departmentDB = new DepartmentDB();
        $department = $departmentDB->getNom($user["department"]);
        $departmentDB = null;
    }

    include_once("Classes/Roles.php");
    $role = Roles::getName($user["role"]);
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "go_back"> <a href="Pipes/login_redirect.php">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="Pipes/deconnexion.php">Se deconnecter</a></h3>
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
                    echo "<img src='Assets/imgs/profile_picture_female.png'>";
                } else {
                    echo "<img src='Assets/imgs/profile_picture_male.png'>";
                }
            ?>
            
            <h2>Informations:</h2>
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
                        if ($user["role"] == 3) {
                            echo "<li> <span>Department:</span> ".$department." </li>
                            <br>
                            <br>";
                        }
                    ?>

                </ul>

            </div>
        </div>
    </div>

</div>

</div>
</body>