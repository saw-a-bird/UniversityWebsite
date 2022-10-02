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
 
    require_once("Classes/AdminDB.php");
    $adminDB = new AdminDB();
    $users = $adminDB->getIList();
    $adminDB = null;

    require_once("Classes/UtilisateurDB.php");
    $utilisateurDB = new UtilisateurDB();
    $state = $utilisateurDB->getIState();
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
            <h3 class = "go_back"> <a href="Pipes/login_redirect.php">Go back</a></h3>
            <h3 class = "deconnection"> <a href="Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>

</div>

<div class="cadre" >
    <div class = "cadre_header">
        <div class = "forms">
            <div>Inscription:   
                <select id="inscription_select" class="drop_form" name="role" onchange="selectIState()">
                    <option value="0">Fermé</option>
                    <option value="1">Ouvert</option>
                </select>
                <button type = "button" id = "valider_btn" class = "_btn valider_btn" onclick="changeIState()" disabled> Changer </button>
            </div> 
            <div>Search:   
                <select id="search_filter_form" class="drop_form" name="role">
                    <option value="1">CIN</option>
                    <option value="2">Nom et prenom</option>
                </select>
                <input id= "search_input" type="text" class="lab_in_txt" name = "CIN" placeholder = "something..." required>
                <button type = "button" class = "_btn search_btn" onclick="search()"> Search </button>
            </div> 
        </div>
        <div class = "adm_btns">
            <a href = "inscr_ajouter_form.php"><button class = "_btn add_btn"> Ajouter </button></a>
            <a href = "Pipes/inscr_reset.php" onclick="return confirm('DELETION: Are you sure you want to remove ALL items in the inscriptions table?');"><button class = "_btn reset_btn"> Réinitialiser </button> </a>
        </div>
    </div>
    <table id ="table_adm" class="scrollable-table">
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
                if (is_array($users)) {
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
                }
            ?>
        </tbody>
    </table>
</div>

<script>
    var website_link = "<?= HOST ?>";
    var IState = <?= $state ?>;
    var inscription_select = document.getElementById("inscription_select");
    inscription_select.options[IState].selected = true;
    
    var valider_btn = document.getElementById("valider_btn");

    function selectIState() {
        valider_btn.disabled = (inscription_select.selectedIndex == IState);
    }

    function changeIState() {
        if (confirm("WARNING!!!! Are you sure you want to "+(IState == 1? "OPEN": "CLOSE")+" inscription to this website?")) {
            window.location.href = website_link+"Pipes/change_state.php?state="+(IState+1); // (0+1) % 2 = 1 // (1+1) % 2 = 0
        }
    }

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