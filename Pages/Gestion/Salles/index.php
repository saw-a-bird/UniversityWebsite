<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 0;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Gérer les salles </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>

<?php
    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/SalleDB.php");
    $salleDB = new SalleDB();
    $salles = $salleDB->getAll();
    $salleDB = null;
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
<div class="cadre">
    <h1> Tableau de salles: </h1>
    <div class = "cadre_header">
        
        <div class = "forms">

        </div>

        <div class = "_tool_buttons" style = "margin-right:0">
            <a href = "ajouter.php"><button class = "_btn _green_btn" style = "margin-right:0"> Ajouter un salle </button></a>
        </div>
    </div>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:60%"><span class = "table_header">Nom</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($salles as $salle) {
                    echo "
                        <tr>
                            <td >".$salle["nom"]."</td>
                            <td>
                                <a class = 'link_ref' href = '/Pipes/Salle/supprimer.php?nom=".$salle["nom"]."'>Supprimer</a>
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