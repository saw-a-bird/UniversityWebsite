<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 0;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Gestion d'inscriptions </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>
    <?php
        require_once(ROOT."/Classes/Database/GlobalDB.php");
        $globalDB = new GlobalDB();
        $state = $globalDB->getInscription();
        $globalDB = null;

        require_once(ROOT."/Classes/Database/InscriptionDB.php");
        $inscriptionDB = new InscriptionDB();
        $inscriptions = $inscriptionDB->getAll();

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
        <div class="cadre" id = "cadre">
        <h1 class = "table_name"> Tableau d'inscription: </h1>
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
                            <option value="3">Role</option>
                            <option value="4">Etat d'inscription</option>
                        </select>
                        <input id= "search_input" type="text" class="lab_in_txt" name = "CIN" placeholder = "something..." required>
                        <button type = "button" class = "_btn search_btn" onclick="search()"> Search </button>
                    </div> 
                </div>
                <div class = "_tool_buttons">
                    <a href = "ajouter.php"><button class = "_btn _green_btn"> Ajouter </button></a>
                    <a href = "/Pipes/adm_insr_reset.php" onclick="return confirm('DELETION: Are you sure you want to remove ALL items in the inscriptions table?');"><button class = "_btn _red_btn"> Réinitialiser </button> </a>
                </div>
            </div>
            <table id ="table_" class="scrollable-table">
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
                        foreach ($inscriptions as $key => $inscrit) {
                            echo "
                                <tr>
                                    <td>".$inscrit["cin"]."</td>
                                    <td>".$inscrit["nomprenom"]."</td>
                                    <td>".Roles::getName($inscrit["role"])."</td>
                                    <td>". ($inscrit["isSubscribed"] == 1? "Oui": "Non")."</td>
                                    <td>
                                        <a class = 'link_ref' href = 'modifier.php?id=".$inscrit["id"]."'>Modifier</a>
                                        <a class = 'link_ref' href = '/Pipes/adm_insr_supprimer.php?id=".$inscrit["id"]."' onclick=\"return confirm('DELETION: Are you sure you want to remove \'".$inscrit["nomprenom"]."\' from the table?');\">Supprimer</a> 
                                </td>
                            </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var IState = <?= $state ?>;
        var inscription_select = document.getElementById("inscription_select");
        inscription_select.options[IState].selected = true;
        
        var valider_btn = document.getElementById("valider_btn");

        function selectIState() {
            valider_btn.disabled = (inscription_select.selectedIndex == IState);
        }

        function changeIState() {
            if (confirm("WARNING!!!! Are you sure you want to "+(IState == 0? "OPEN": "CLOSE")+" inscription to this website?")) {
                window.location.href = "/Pipes/change_state.php?state="+(IState+1); // (0+1) % 2 = 1 // (1+1) % 2 = 0
            }
        }

    </script>

    <script src="/Assets/js/specific_search.js" tables ="cadre"></script>
</body>
</html>