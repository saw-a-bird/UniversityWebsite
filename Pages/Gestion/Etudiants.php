<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Gerer les etudiants </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
</head>
<body>
<?php

    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/UtilisateurDB.php");
    $utilisateurDB = new UtilisateurDB();

    $users = $utilisateurDB->getList(Roles::ByName("Etudiant"), $user["departmentID"]);
    $utilisateurDB = null;
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
    <h1> Tableau d'etudiants: </h1>
    <div class = "cadre_header">
        
        <div class = "forms">
            <div>Search:   
                <select id="search_filter_form" class="drop_form" name="role">
                    <option value="1">Matricule</option>
                    <option value="2">CIN</option>
                    <option value="3">Nom et prenom</option>
                </select>
                <input id= "search_input" type="text" class="lab_in_txt" name = "CIN" placeholder = "something..." required>
                <button type = "button" class = "_btn search_btn" onclick="search()"> Search </button>
            </div> 
        </div>
    </div>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:10%"><span class = "table_header">Matricule</span></th>
                <th style = "width:10%"><span class = "table_header">CIN</span></th>
                <th style = "width:20%"><span class = "table_header">Nom et prenom</span></th>
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
                                <a class = 'link_ref' href = '/Pages/User/Account/public.php?matricule=".$user["matricule"]."'>Details</a>
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