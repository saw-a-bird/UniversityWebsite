<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Gérer les classes </title>
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
    $classes = $classeDB->getAllByDepartment($user["departmentID"]); // byAnne
    $classeDB = null;
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
    <h1> Tableau de classes: </h1>
    <div class = "cadre_header">
        <div class = "forms"></div>
        <div class = "_tool_buttons" style = "margin-right:0">
            <a href = "ajouter.php"><button class = "_btn _green_btn" style = "margin-right:0"> Ajouter un classe </button></a>
        </div>
    </div>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:30%"><span class = "table_header">Parcours</span></th>
                <th style = "width:20%"><span class = "table_header">Numero</span></th>
                <!-- <th style = "width:20%"><span class = "table_header">Nombre de groups</span></th> -->
                <th style = "width:20%"><span class = "table_header">Nombre d'etudiants</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($classes as $classe) {
                    echo "
                        <tr>
                            <td>".$classe["parcoursNom"]."</td>
                            <td>".$classe["numero"]."</td>
                            <td>".$classe["etudiants"]."</td>
                            <td>
                                <a class = 'link_ref' href = 'Emploi/modifier.php?classeId=".$classe["id"]."'>Emploi</a>
                                <a class = 'link_ref' href = 'Groupes/index.php?classeId=".$classe["id"]."'>Groupes</a>
                                <a class = 'link_ref' href = '/Pipes/Classes/supprimer.php?id=".$classe["id"]."'>Supprimer classe</a>
                            </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
</div>

<script src="/Assets/js/specific_search.js" tables ="cadre"></script>

</body>
</html>