<!DOCTYPE html>
<head>
<link rel="stylesheet" href="Assets/css/user.css">
<link rel="stylesheet" href="Assets/css/profil.css">
<link rel="stylesheet" href="Assets/css/adm_liste_inscription.css">
</head>
<body>
<?php
    session_start();
    include("Pipes/get_login.php");
    include("config.php");
 
    include("Classes/AdminDB.php");
    $adminDB = new AdminDB();
    $users = $adminDB->getIList();

    include("Classes/Roles.php");
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "go_back"> <a href="Pipes/login_redirect.php">Go back</a></h3>
            <h3 class = "deconnection"> <a href="Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>

</div>

<div class="cadre" >
    <div class = "cadre_header">
        <div class = "forms">
            <div>Inscription:   
                <select id="inscription_select" class="drop_form" name="role">
                    <option value="1">Ouvert</option>
                    <option value="2">Fermé</option>
                </select>
                <button type = "button" class = "_btn valider_btn"> Valider </button>
            </div> 
            <div>Search:   
                <select id="filterby_form" class="drop_form" name="role">
                    <option value="1">CIN</option>
                    <option value="2">Nom et prenom</option>
                </select>
                <input type="text" class="lab_in_txt" name = "CIN" placeholder = "something..." required>
                <button type = "button" class = "_btn search_btn"> Search </button>
            </div> 
        </div>
        <div class = "adm_buttons">
            <button> Ajouter </button>
            <button> Réinitialiser </button>
        </div>
    </div>
    <table class="table_adm scrollable-table">
        <thead>
            <tr> 
                <th style = "width:20%"><span class = "table_header">CIN</span></th>
                <th style = "width:30%"><span class = "table_header">Nom et prenom</span></th>
                <th><span class = "table_header">Role</span></th>
                <th><span class = "table_header">Inscrit?</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($users as $key => $user) {
                    echo "
                        <tr>
                            <td>".$user["cin"]."</td>
                            <td>".$user["nomprenom"]."</td>
                            <td>".Roles::getName($user["role"])."</td>
                            <td>". ($user["isSubscribed"] == 1? "Oui": "Non")."</td>
                            <td><button>Supprimer</button></td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>



</body>
</html>