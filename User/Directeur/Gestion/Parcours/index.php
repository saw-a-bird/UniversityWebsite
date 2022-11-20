<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Gérer les parcours </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>

<?php
    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/ParcoursDB.php");
    $parcoursDB = new ParcoursDB();
    $parcoursAll = $parcoursDB->getAllByDepartment($user["departmentID"]);
    $parcoursDB = null;
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

<div class="cd">
<div class="cadre">
    <h1> Tableau de parcours: </h1>
    <div class = "cadre_header">
        
        <div class = "forms">

        </div>

        <div class = "_tool_buttons" style = "margin-right:0">
            <a href = "ajouter.php"><button class = "_btn _green_btn" style = "margin-right:0"> Ajouter </button></a>
        </div>
    </div>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:20%"><span class = "table_header">Nom</span></th>
                <th style = "width:70%"><span class = "table_header">Filiere</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($parcoursAll as $parcours) {
                    echo "
                        <tr>
                            <td>".$parcours["nom"]."</td>
                            <td>".$parcours["filiere"]."</td>
                            <td>
                                <a class = 'link_ref' href = 'modifier.php?id=".$parcours["id"]."'>Modifier</a>
                                <a class = 'link_ref' href = '/Pipes/Parcours/supprimer.php?id=".$parcours["id"]."'>Supprimer</a>
                            </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
</div>

</body>
</html>