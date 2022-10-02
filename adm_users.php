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
 
    require_once("Classes/UtilisateurDB.php");
    $utilisateurDB = new UtilisateurDB();
    $users = $utilisateurDB->getAll();
    $utilisateurDB = null;

    require_once("Classes/Roles.php");
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

<div class="cd">
<div class="cadre" >
<h1> Tableau d'utilisateurs: </h1>
    <div class = "cadre_header">
        
        <div class = "forms">
            <div>Search:   
                <select id="search_filter_form" class="drop_form" name="role">
                    <option value="1">Matricule</option>
                    <option value="2">CIN</option>
                    <option value="3">Nom et prenom</option>
                    <option value="4">Role</option>
                </select>
                <input id= "search_input" type="text" class="lab_in_txt" name = "CIN" placeholder = "something..." required>
                <button type = "button" class = "_btn search_btn" onclick="search()"> Search </button>
            </div> 
        </div>
    </div>
    <table id ="table_adm" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:10%"><span class = "table_header">Matricule</span></th>
                <th style = "width:10%"><span class = "table_header">CIN</span></th>
                <th style = "width:20%"><span class = "table_header">Nom et prenom</span></th>
                <th><span class = "table_header">Role</span></th>
                <th><span class = "table_header">Date d'inscription</span></th>
                <th><span class = "table_header">Active?</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (is_array($users)) {
                    foreach ($users as $key => $user) {
                        echo "
                            <tr>
                                <td>".$user["matricule"]."</td>
                                <td>".$user["CIN"]."</td>
                                <td>".$user["nom"]." ".$user["prenom"]."</td>
                                <td>".Roles::getName($user["role"])."</td>
                                <td>".$user["dateInscription"]."</td>
                                <td>". ($user["isActive"] == 1? "Oui": "Non")."</td>
                                <td>
                                <a class = 'link_ref' href = 'user_see_details.php?cin=".$user["CIN"]."'>Details</a>
                                <a class = 'link_ref' href = 'Pipes/adm_supprimer_user.php?cin=".$user["CIN"]."' onclick=\"return confirm('DELETION: Are you sure you want to remove USER #\'".$user["matricule"]."\' from the database?');\">Supprimer</a> 
                                </td>
                            </tr>
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
</div>
</div>
<script>

    var table = document.getElementById("table_adm");
    var tr = table.getElementsByTagName("tr");
    var input = document.getElementById("search_input");
    var filterSelect = document.getElementById("search_filter_form");

    function search() {
    // Declare variables
        var textInput, td, i, txtValue, filterBy;
        textInput = input.value.toUpperCase();
        filterBy = filterSelect.selectedIndex;

        // Loop through all table rows, and hide those who don't match the search query

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[filterBy];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(textInput) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>