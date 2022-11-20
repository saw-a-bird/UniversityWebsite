<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 0;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Liste de sessions </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>
    <?php
        require_once(ROOT."/Classes/Database/SessionDB.php");
        $sessionsDB = new SessionDB();
        $sessions = $sessionsDB->getAll();
        $sessionsDB = null;

        require_once(ROOT."/Classes/Database/GlobalDB.php");
        $globalDB = new GlobalDB();
        $currentSession = $globalDB->getSession()["numero"];
        $globalDB = null;
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
        <h1 class = "table_name"> Tableau de sessions: </h1>
            <div class = "cadre_header">
                <div class = "forms">
                    <div>Search:   
                        <select id="search_filter_form" class="drop_form" name="num">
                            <option value="1">Numero</option>
                            <option value="2">Anne</option>
                        </select>
                        <input id= "search_input" type="text" class="lab_in_txt" name = "numero" placeholder = "something..." required>
                        <button type = "button" class = "_btn search_btn" onclick="search()"> Chercher </button>
                    </div> 
                </div>
                <div class = "_tool_buttons">
                    <a href = "new.php"><button class = "_btn _green_btn"> Créer un nouveau session</button></a>
                </div>
            </div>
            <table id ="table_" class="scrollable-table">
                <thead>
                    <tr> 
                        <th style = "width:10%"><span class = "table_header">Session#</span></th>
                        <th style = "width:30%"><span class = "table_header">Anne</span></th>
                        <th style = "width:25%"><span class = "table_header">Semestre</span></th>
                        <th style = "width:25%"><span class = "table_header">Actuel?</span></th>
                        <th style = "width:10%"><span class = "table_header">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($sessions as $key => $session) {
                            echo "
                                <tr>
                                    <td>".$session["numero"]."</td>
                                    <td>".$session["anne"]."</td>
                                    <td>".$session["semestre"]."</td>
                                    <td>".($session["numero"] == $currentSession? "Oui" : "Non")."</td>
                                    <td>
                                        <a class = 'link_ref' href = '/Pipes/Sessions/select.php?numero=".$session["numero"]."'>Select</a>
                                        <a class = 'link_ref' href = 'modifier.php?numero=".$session["numero"]."'>Modifier</a>
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