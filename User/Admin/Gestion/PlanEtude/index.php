<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 2;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Gestion de plan d'etudes </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>
    <?php
        require_once(ROOT."/Classes/PlanEtudeDB.php");
        $planEtudeDB = new PlanEtudeDB();
        $planEtudes = $planEtudeDB->getAllByDepartmentID($user["departmentID"]);
        $planEtudeDB = null;

        require_once(ROOT."/Classes/DepartmentDB.php");
        $departmentDB = new DepartmentDB();
        $depNom = $departmentDB->getNom($user["departmentID"]);
        $departmentDB = null;
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
        <div class="cadre" >
        <h1 class = "table_name"> Plan etudes de department <?= $depNom ?>: </h1>
            <div class = "cadre_header">
                <div class = "forms">
                    <div>Search:   
                        <select id="search_filter_form" class="drop_form" name="role">
                            <option value="1">Parcours</option>
                            <option value="2">Anne Debut</option>
                            <option value="3">Anne Fin</option>
                        </select>
                        <input id= "search_input" type="text" class="lab_in_txt" name = "CIN" placeholder = "something..." required>
                        <button type = "button" class = "_btn search_btn" onclick="search()"> Search </button>
                    </div> 
                </div>
                <div class = "_tool_buttons">
                    <a href = "ajouter.php"><button class = "_btn _green_btn"> Ajouter </button></a>
                </div>
            </div>
            <table id ="table_" class="scrollable-table">
                <thead>
                    <tr> 
                        <th style = "width:10%"><span class = "table_header">ID#</span></th>
                        <th style = "width:30%"><span class = "table_header">Parcours</span></th>
                        <th><span class = "table_header">Date Debut</span></th>
                        <th><span class = "table_header">Date Fin</span></th>
                        <th><span class = "table_header">Selectionné?</span></th>
                        <th><span class = "table_header">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($planEtudes as $key => $plan) {
                            $selected = $plan["planSelectionné"] == $plan["id"];
                            echo "
                                <tr>
                                    <td>".$plan["id"]."</td>
                                    <td>".$plan["parcoursNom"]."</td>
                                    <td>".$plan["dateDebut"]."</td>
                                    <td>".$plan["dateFin"]."</td>
                                    <td>".($selected? "Oui": "Non")."</td>
                                    <td>
                                        <a class = 'link_ref' href = 'afficher.php?id=".$plan["id"]."'>Afficher</a>
                                        ". ($selected == false?
                                        "<a class = 'link_ref' href = '/Pipes/PlanEtude/selectionner_plan.php?plan_id=".$plan["id"]."&parcours_id=".$plan["parcoursID"]."'>Selectionner</a>" : "<a class = 'link_ref' href = '/Pipes/PlanEtude/selectionner_plan.php?plan_id=-1&parcours_id=".$plan["parcoursID"]."'>Déselectionner</a>") ."
                                        <a class = 'link_ref' href = 'modifier.php?id=".$plan["id"]."'>Modifier</a>
                                        <a class = 'link_ref' href = '/Pipes/PlanEtude/supprimer_planEtude.php?id=".$plan["id"]."' onclick=\"return confirm('DELETION: Are you sure you want to remove PlanEtude #".$plan["id"]." from the table?');\">Supprimer</a> 
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