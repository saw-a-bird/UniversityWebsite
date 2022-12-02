<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
        
        $groupeId = $_GET["groupeId"];
        require_once(ROOT."/Classes/Database/GroupeDB.php");
        $groupeDB = new GroupeDB();
        $groupe = $groupeDB->get($groupeId);
        $groupeDB = null;
    

        $designationClasse = $groupe["parcoursNom"].".".$groupe["classeNumero"]." (G".$groupe["groupeNumero"].")";
    ?>

    <title><?= $authName ?> - Classe <?php $designationClasse?> - Liste d'etudiants </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
    <link rel="stylesheet" href="/Assets/css/dialogwindow.css">
</head>
<body>

<?php
    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/EtudiantGroupDB.php");
    $etudiantGroupDB = new EtudiantGroupDB();
    $etdGroups = $etudiantGroupDB->getAll($groupeId);
    $etudiants = $etudiantGroupDB->availableByDepartment($user["departmentID"]);
    $etudiantGroupDB = null;
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">     
            <h3 class = "print_page"> <a onclick = "print_page()">Imprimer </a></h3>
            <h3 class = "go_back"> <a href="../index.php?classeId=<?= $groupe["classeID"] ?>">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>

<div class="cd">
    <div class="cadre" id = "cadre">
        <h1 id = "table_name"> Tableau d'etudiants de la classe <?=$designationClasse?></h1>
        <div class = "cadre_header">
            <div class = "forms"></div>
            <div class = "_tool_buttons" style = "margin-right:0">
                <a><button class = "_btn _green_btn" id ="open-modal" style = "margin-right:0"> Ajouter un etudiant </button></a>
            </div>
        </div>

        <table id ="table_"  class="scrollable-table" >
            <thead>
                <tr> 
                    <th style = "width:20%"><span class = "table_header">Matricule</span></th>
                    <th style = "width:50%"><span class = "table_header">Nom et prenom</span></th>
                    <th class = "table_actions"><span class = "table_header">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($etdGroups as $etudiantGrp) {
                        echo "
                            <tr>
                                <td>".$etudiantGrp["matricule"]."</td>
                                <td>".$etudiantGrp["nomprenom"]."</td>
                                <td class = 'table_actions'>
                                    <a class = 'link_ref' href = '/Pipes/Classes/Groupes/Etudiants/retirer.php?matricule=".$etudiantGrp["matricule"]."&groupeId=".$groupeId."'>Retirer</a>
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
        <h1 > Liste d'etudiants disponible </h1>
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
                    foreach ($etudiants as $etudiant) {
                        echo "
                            <tr id = 'etd_".$etudiant["matricule"]."'>
                                <td>".$etudiant["matricule"]."</td>
                                <td>".$etudiant["nomprenom"]."</td>
                                <td class = 'dialog_link'>
                                    <a class = 'link_ref' onclick='waitingList(".$etudiant["matricule"].")'>Selectionner</a>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
 
        <?php
            if (count($etudiants) == 0) {
                echo "<p style = 'color:red; font-weight:bold; text-align: center; font-size:18px'> Aucune etudiant disponible maintenant. </p>"; 
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

        const groupeId = <?= $groupeId ?>;
        
        const modal = document.querySelector('.open-modal');
        const reinitialiserBtn = document.querySelector('.reinit_btn');
        const confirmerBtn = document.querySelector('.confirm_btn');

        var studentWaiting = [];

        document.querySelector('#open-modal').addEventListener('click', function(){
            modal.showModal();
        });


        document.querySelector('.close-modal').addEventListener('click',function(){
            modal.close();
        })

        function waitingList(matricule) {
            var index = studentWaiting.indexOf(matricule)
            if (index == -1) {
                document.querySelector('#etd_'+matricule).classList.add("selected_student");
                studentWaiting.push(matricule);

                if (studentWaiting.length == 1) {
                    reinitialiserBtn.disabled = false;
                    confirmerBtn.disabled = false;
                }
                
            } else {
                document.querySelector('#etd_'+matricule).classList.remove("selected_student");
                studentWaiting.splice(index, 1)

                if (studentWaiting.length == 0) {
                    reinitialiserBtn.disabled = true;
                    confirmerBtn.disabled = true;
                }
            }
        }

        function reinitialiser() {
            if (confirm("Réinitialiser la liste d'etudiants selectionné?")) {
                studentWaiting.forEach(matricule => {
                    document.querySelector('#etd_'+matricule).classList.remove("selected_student");
                });
                studentWaiting = [];
                reinitialiserBtn.disabled = false;
                confirmerBtn.disabled = false;
            }
        }

        function confirmer() {
            if (confirm("Ajouter ces etudiants au groupe?")) {
                window.location.href = "/Pipes/Classes/Groupes/Etudiants/ajouter.php?groupeId="+groupeId+"&addArray="+JSON.stringify(studentWaiting);
            }
        }
    </script>

    
<script>
        divToPrint = document.getElementById("table_").cloneNode(true);
        
        function print_page() {
            tableTitle = document.getElementById("table_name").innerHTML;

            actionsTable = divToPrint.querySelectorAll(".table_actions");
            actionsTable.forEach((v, k) => {
                v.style.display = "none"
            })

            var newWin = window.open(
                            "http://isetso.local/",
                            tableTitle,
                            "width=420,height=230,resizable,scrollbars=yes,status=1"
                            )
            newWin.document.write(tableTitle);
            divToPrint.setAttribute("border",'1');
            divToPrint.setAttribute("cellpadding",'0');
            divToPrint.setAttribute("style",'border: 1px solid rgb(206, 140, 41);');
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();

            actionsTable.forEach((v, k) => {
                v.style.display = ""
            })
        }
</script>

    <script src="/Assets/js/specific_search.js" tables ="modal_table,cadre"></script>
</body>
</html>