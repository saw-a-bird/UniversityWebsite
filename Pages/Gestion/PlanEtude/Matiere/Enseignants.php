<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");

        $matiereId = $_GET["matiereId"];
        $planId = $_GET["planId"];
    ?>

    <title><?= $authName ?> - Matiere #<?= $matiereId ?> - Liste d'enseignants </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">

    <style>

        .selected_student {
            background-color: rgb(239 206 155);
        }

        dialog::backdrop {
            background: rgba(0, 0, 0, 0.3);
        }

        .dialog_link:hover {
            font-weight:bold
        }
        
        .dialog_link .link_ref:hover {
            background-color: transparent;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php


    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/EnseignantMatiereDB.php");
    $ensMatiereDB = new EnseignantMatiereDB();
    $enseignants = $ensMatiereDB->getAll($matiereId);
    $enseignantsAvailable = $ensMatiereDB->available($user["departmentID"], $matiereId);
    $ensMatiereDB = null;

    require_once(ROOT."/Classes/Database/MatiereDB.php");
    $matiereDB = new MatiereDB();
    $matiere = $matiereDB->get($matiereId);
    $matiereDB = null;
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "go_back"> <a href="../afficher.php?id=<?= $planId ?>">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>

<div class="cd">
<div class="cadre" id = "cadre">
    <h1> Tableau d'enseignants de la matiere <?=$matiere["nom"]?>: </h1>
    <div class = "cadre_header">
        <div class = "forms"></div>
        <div class = "_tool_buttons" style = "margin-right:0">
            <a><button class = "_btn _green_btn" id ="open-modal" style = "margin-right:0"> Ajouter un enseignant </button></a>
        </div>
    </div>

    <table id ="table_"  class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:20%"><span class = "table_header">Matricule</span></th>
                <th style = "width:50%"><span class = "table_header">Nom et prenom</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($enseignants as $enseignant) {
                    echo "
                        <tr>
                            <td>".$enseignant["matricule"]."</td>
                            <td>".$enseignant["nomprenom"]."</td>
                            <td>
                                <a class = 'link_ref' href = '/Pipes/PlanEtudes/Matiere/retirer.php?planId=". $planId."&matricule=".$enseignant["matricule"]."&matiereId=".$matiereId."'>Retirer</a>
                            </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
</div>



<dialog id = "modal_table" class="open-modal" style = "width:50%; border-radius: 20px; border-color: #9d9d9d;">
        <h1> Liste d'enseignants disponible </h1>
        <div class = "cadre_header">
            <div class = "forms">
                <div>Search:   
                    <select id="search_filter_form" class="drop_form" name="role">
                        <option value="1">Matricule</option>
                        <!-- <option value="3">Nom et prenom</option> -->
                    </select>
                    <input id= "search_input" type="text" class="lab_in_txt" name = "search" placeholder = "something..." required>
                    <button type = "button" class = "_btn search_btn" onclick="search('modal_table')"> Search </button>
                </div> 
            </div>
        </div>
        <table id ="table_" class="scrollable-table">
            <thead>
                <tr> 
                    <th style = "width:20%"><span class = "table_header">Matricule</span></th>
                    <th style = "width:50%"><span class = "table_header">Nom et prenom</span></th>
                    <th><span class = "table_header">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($enseignantsAvailable as $enseignant) {
                        echo "
                            <tr id = 'etd_".$enseignant["matricule"]."'>
                                <td>".$enseignant["matricule"]."</td>
                                <td>".$enseignant["nomprenom"]."</td>
                                <td class = 'dialog_link'>
                                    <a class = 'link_ref' onclick='waitingList(".$enseignant["matricule"].")'>Selectionner</a>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
 
        <?php
            if (count($enseignantsAvailable) == 0) {
                echo "<p style = 'color:red; font-weight:bold; text-align: center; font-size:18px'> Aucune enseignant disponible pour cette matiere maintenant. </p>"; 
            }
        ?>
        <div class = "_tool_buttons" style = "margin-top:30px; display: flex; flex-direction: row; justify-content:space-between">
            <button class = "_btn _red_btn close-modal" style = "margin-right:0"> Close </button>
            <div>
                <button class="reinit_btn" style = "margin-right:5px" onclick="reinitialiser()" disabled> Réinitialiser</button>
                <button class="confirm_btn" style = "margin-right:0" onclick="confirmer()" disabled> Confirmer</button>
            </div>
        </div>
    </dialog>
  

      <script>
        const planId = <?= $planId ?>;
        const matiereId = <?= $matiereId ?>;
        
        const modal = document.querySelector('.open-modal');
        const reinitialiserBtn = document.querySelector('.reinit_btn');
        const confirmerBtn = document.querySelector('.confirm_btn');

        var waiting = [];

        document.querySelector('#open-modal').addEventListener('click', function(){
            modal.showModal();
        });


        document.querySelector('.close-modal').addEventListener('click',function(){
            modal.close();
        })

        function waitingList(matricule) {
            var index = waiting.indexOf(matricule)
            if (index == -1) {
                document.querySelector('#etd_'+matricule).classList.add("selected_student");
                waiting.push(matricule);

                if (waiting.length == 1) {
                    reinitialiserBtn.disabled = false;
                    confirmerBtn.disabled = false;
                }
                
            } else {
                document.querySelector('#etd_'+matricule).classList.remove("selected_student");
                waiting.splice(index, 1)

                if (waiting.length == 0) {
                    reinitialiserBtn.disabled = true;
                    confirmerBtn.disabled = true;
                }
            }
        }

        function reinitialiser() {
            if (confirm("Réinitialiser la liste d'etudiants selectionné?")) {
                waiting.forEach(matricule => {
                    document.querySelector('#etd_'+matricule).classList.remove("selected_student");
                });
                waiting = [];
                reinitialiserBtn.disabled = false;
                confirmerBtn.disabled = false;
            }
        }

        function confirmer() {
            if (confirm("Ajouter ces etudiants au groupe?")) {
                window.location.href = "/Pipes/PlanEtudes/Matiere/ajouter.php?planId="+planId+"&matiereId="+matiereId+"&addArray="+JSON.stringify(waiting);
            }
        }
    </script>

    <script src="/Assets/js/specific_search.js" tables ="modal_table,cadre"></script>
</body>
</html>