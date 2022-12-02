<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 4;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Classe </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>

<?php
    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/ClasseDB.php");
    $classeDB = new ClasseDB();
    $classe = $classeDB->getByEtudiant($user["matricule"]); // byAnne
    $classeDB = null;

    require_once(ROOT."/Classes/Database/EtudiantGroupDB.php");
    $etudiantGroupDB = new EtudiantGroupDB();
    $etdGroups = $etudiantGroupDB->getAllGroups($classe["id"]);
    $etudiantGroupDB = null;
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div"> 
            <h3 class = "go_back"> <a href="/Pages/User/index.php">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>


<div class="cd">
    <div class="cadre" id = "cadre">
        <h1> Tableau d'etudiants de la classe <?=$classe["parcoursNom"].".".$classe["classNumero"]?>: </h1>

        <table id ="table_"  class="scrollable-table">
            <thead>
                <tr> 
                    <th style = "width:50%"><span class = "table_header">Nom et prenom</span></th>
                    <th style = "width:50%"><span class = "table_header">Group</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($etdGroups as $etudiantGrp) {
                        echo "
                            <tr>
                                <td>".$etudiantGrp["nomprenom"]."</td>
                                <td>G".$etudiantGrp["numero"]."</td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>

<script src="/Assets/js/specific_search.js" tables ="cadre"></script>
</body>
</html>