<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 0;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Gérer les directeurs </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
</head>
<body>

<?php
    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/UtilisateurDB.php");
    $utilisateurDB = new UtilisateurDB();

    $users = $utilisateurDB->getListDirecteurs(Roles::ByName("Directeur"));
    $utilisateurDB = null;
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
    <h1> Tableau de directeurs: </h1>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:10%"><span class = "table_header">Matricule</span></th>
                <th style = "width:10%"><span class = "table_header">CIN</span></th>
                <th style = "width:20%"><span class = "table_header">Nom et prenom</span></th>
                <th style = "width:20%"><span class = "table_header">Department</span></th>
                <th><span class = "table_header">Date d'inscription</span></th>
                <th><span class = "table_header">Active?</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($users as $key => $user) {
                    echo "
                        <tr>
                            <td>".$user["matricule"]."</td>
                            <td>".$user["cin"]."</td>
                            <td>".$user["nom"]." ".$user["prenom"]."</td>
                            <td>".$user["dateInscription"]."</td>
                            <td>". ($user["isActive"] == 1? "Oui": "Non")."</td>
                            <td>
                                <a class = 'link_ref' href = '/User/Account/public.php?matricule=".$user["matricule"]."'>Details</a>
                            </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
</div>

<script src="/Assets/js/search.js"></script>
</body>
</html>