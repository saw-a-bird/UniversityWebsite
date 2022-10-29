<!DOCTYPE html>
<head>
    <?php
        session_start();
        $leastRole = 3;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title> Utilisateur - Fiche Publique </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
</head>
<body>
    <?php
        require_once(ROOT."/Classes/UtilisateurDB.php");
        $utilisateurDB = new UtilisateurDB();

        if (isset($_GET["matricule"]) && is_numeric($_GET["matricule"])) {
            $person = $utilisateurDB->getUserByMatricule($_GET["matricule"]);
            if ($person === -1) {
                header("location: /User/Account/not_found.php");
            } else {
                include(ROOT."/Classes/Utilisateur.php");
                $sexe = Utilisateur::getSexeName($person["sexe"]);
            
                if (isset($person["departmentID"])) {
                    include(ROOT."/Classes/DepartmentDB.php");
                    $departmentDB = new DepartmentDB();
                    $department = $departmentDB->getNom($person["departmentID"]);
                    $departmentDB = null;
                }
            
            //include_once(ROOT."/Classes/Roles.php");
                $role = Roles::getName($person["role"]);
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
                <h3 class = "go_back"> <a href="../index.php">Retourner</a></h3>
                <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
            </div>
        </div>
    </div>

    <div class="cd">
        <div class="cadre">
            <div class="pg">
            
                <div class="img_container">
                    <?php
                        if ($user["sexe"] == 0) {
                            echo "<img src='/Assets/imgs/profile_picture_female.png'>";
                        } else {
                            echo "<img src='/Assets/imgs/profile_picture_male.png'>";
                        }
                    ?>
                    
                    <h1>Fiche d'utilisateur #<?= $user["matricule"] ?></h1>
                </div>
                <div class = "flex-box">
                    <div class="form_">
                        <ul>

                            <li> <span>Role:</span> <u><?= $role ?></u></li>
                            <br>
                            <br>

                            <li><span>Nom:</span> <?= $person["nom"] ?> </li>
                        
                            <br>
                            <br>
                    
                            <li>
                            <span>Prenom:</span> <?= $person["prenom"] ?>
                            </li>
                            <br>
                            <br>
                    
                            <li>
                            <span>Sexe:</span>  <?= $sexe ?>
                            </li>
                            <br>
                            <br>
                        
                            <li> <span>Date de naissance:</span>  <?= $person["dateNaissance"] ?>

                            </li> 
                            <br>
                            <br>

                        </ul>
                    </div>
                    <div class="verticalLine"></div>
                    <div class="form_">
                        <ul>

                            <li> <span>Date d'inscription:</span>  <?= $person["dateInscription"] ?> </li> 
                            <br>
                            <br>

                            <?php 
                                if (isset($department)) {
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