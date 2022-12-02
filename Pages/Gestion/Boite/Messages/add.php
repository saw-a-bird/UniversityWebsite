<!--maaneha fyha (CIN, nomprenom less9yn, Role)
     button tee l'addition excel Import Excel table Ajouter Inscription-->
     <!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        $securityRole = 3;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Créer un nouveau message </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/secondary_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/boite.css">
    <link rel="stylesheet" href="/Assets/css/dialogwindow.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">

    <style>
        #cible-input {
            width: 200px;
        }
    </style>
</head>
<body>
    <?php
        $notification = "";
        if (isset($_POST["confirm_btn"])) {
            if (isset($_POST["cible"]) && isset($_POST["title"]) && isset($_POST["content"])) {
                $titlePost = $_POST["title"];
                $contentPost = $_POST["content"];

                $cible = json_decode($_POST["cible"]);
                if (count($cible) > 0) {
                    require_once(ROOT."/Classes/Database/BoiteDB.php");
                    $boiteDB = new BoiteDB();
                    $insertedId = $boiteDB->insert($user["matricule"], $titlePost, $contentPost);

                    if ($insertedId != null) {
                        foreach ($cible as $matricule) {
                            try {
                                $boiteDB->add($matricule, $insertedId);
                            } catch (Exception $e) {
                                echo 'Caught exception: ',  $e->getMessage(), "\n";
                            }
                            
                        }

                        $notification = "<p class = 'green_alert'>La message est ajouté avec succes.</p>"; 
                    } else {
                        $notification = "<p class = 'red_alert'>Error de requête! Contacter l'administrateur!</p>";
                    }
                } else {
                    $notification = "<p class = 'red_alert'>N'aucune utilisateur(s) selectionnée(s)!</p>";
                }
            } else {
                $notification = "<p class = 'red_alert'>La formulaire est erroné</p>";
            }
        }
    ?>
         <!--logo and name--> 
    <div class="logo">  
        <div class = "seperated_div">
            <div class = "header_div">
                <img src="/Assets/imgs/LOGO.png">
                <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
            </div>
            <div class = "buttons_div">
                <h3 class = "go_back"> <a href="../sent.php">Retourner</a></h3>
                <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
            </div>
        </div>
    </div>
    <!--form-->
        <div id="messaging_box" style = "top: 20%;">
            <form action="" method="post" id="message_first">
                <div>
                    <h1 class = "inscr_form_title"> Créer un nouveau message: </h1>

                    <?= $notification ?>

                    <label for="cible" class="lab_form"> Cible :</label>
                    <select class="drop_form" name="classe" id = "classe_form" disabled>
                        <option value='1'>Utilisateurs</option>
                    </select> <input type="text" class="lab_in_txt" name = "cibleModal" style = "margin-left:10px"  placeholder="Vide.. Cliquer ici pour ajouter.." id ="cible-input" readonly>
                    <input type = "hidden" id = "cible_array" name = "cible"/>

                    <label for="title" class="lab_form"> Title :</label>
                    <input type="text" class="lab_in_txt" name = "title" value = "<?= (isset($titlePost) ? $titlePost : "") ?>" required>

                    <label for="content" class="lab_form"> Content :</label>
                    <textarea id="content" name="content" class = "lab_in_textarea" rows="4" cols="50" required></textarea>
                    <div class = "form_btns">
                            
                        <div style = "margin: 40px 25px 20px auto;">
                            <a href = "../sent.php" class = "go_back"> Retourner </a>
                            <input type="submit" value="Envoyer" id="Confirmer" name="confirm_btn" onclick="return submitBtn();">
                        </div>
                    </div>
                </div>
            </form>
        </div>



    <dialog id = "modal_users" class="open-modal1" style = "width:50%; border-radius: 20px; border-color: #9d9d9d;">
        <?php
            
            require_once(ROOT."/Classes/Roles.php");
    
            require_once(ROOT."/Classes/Database/UtilisateurDB.php");
            $utilisateurDB = new UtilisateurDB();
            if ($user["role"] == 0) {
                $utilisateurs = $utilisateurDB->getAll(); 
            } else {
                $utilisateurs = $utilisateurDB->getAllByDepartmentID($user["matricule"], $user["departmentID"]);
            }
            $utilisateurDB = null;
        ?>
        <h1> Utilisateurs </h1>
        <div class = "cadre_header">
            <div class = "forms">
                <div>Search:   
                    <select id="search_filter_form" class="drop_form" name="user">
                        <option value="1">Nom et prenom</option>
                        <option value="2">Department</option>
                        <option value="2">Role</option>
                    </select>
                    <input id= "search_input" type="text" class="lab_in_txt" name = "search" placeholder = "something..." required>
                    <button type = "button" class = "_btn search_btn" onclick="search('modal_users')"> Search </button>
                    <button type = "button" class = "_btn search_btn" onclick="selectAll()"> Select All </button>
                </div> 
            </div>
        </div>
        <table id ="table_" class="scrollable-table">
            <thead>
                <tr> 
                    <th style = "width:35%"><span class = "table_header">Nom et prenom</span></th>
                    <th style = "width:20%"><span class = "table_header">Departement</span></th>
                    <th style = "width:20%"><span class = "table_header">Role</span></th>
                    <th><span class = "table_header">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once(ROOT."/Classes/Database/ClasseDB.php");
                    $classeDB = new ClasseDB();
                    

                    foreach ($utilisateurs as $user) {
                        $roleUser = Roles::getName($user["role"]);
                        if ($user["role"] == 4) {
                            $classe = $classeDB->getByEtudiant($user["matricule"]);
                            if (!empty($classe)) {
                                $roleUser .= " (".$classe["parcoursNom"].".".$classe["classNumero"]." G".$classe["groupNumero"].")";
                            } else {
                                $roleUser .= " (Aucune classe...)";
                            }
                        }

                        echo "
                        
                            <tr id = 'user_".$user["matricule"]."'>
                                <td>".$user["nomprenom"]."</td>
                                <td>".$user["departmentNom"]."</td>
                                <td style = 'font-size: 15px;'>". $roleUser."</td>
                                <td class = 'dialog_link'>
                                    <a class = 'link_ref' onclick='select(".$user["matricule"].")'>Selectionner</a>
                                </td>
                            </tr>
                        ";
                    }

                    $classeDB = null;  
                ?>
            </tbody>
        </table>

        <div class = "_tool_buttons" style = "margin-top:30px; display: flex; flex-direction: row; justify-content:space-between">
            <button class="reinit_btn" style = "margin-right:5px" onclick="reinitialiser()" disabled> Réinitialiser</button>
            
            <div>
            <button class = "_btn _red_btn close-modal1" style = "margin-right:0"> Close </button>
            </div>
        </div>
    </dialog>
  

      <script>
        const modal1 = document.querySelector('.open-modal1');
        const cibleInput = document.querySelector('#cible-input');
        cibleInput.addEventListener('click', function(){
            modal1.showModal();
        });

        document.querySelector('.close-modal1').addEventListener('click',function(){
            modal1.close();
        })
        
        const reinitialiserBtn = document.querySelector('.reinit_btn');

        var usersWaiting = [];
        function select(matricule) {
            var index = usersWaiting.indexOf(matricule)
            if (index == -1) {
                document.querySelector('#user_'+matricule).classList.add("selected_user");
                usersWaiting.push(matricule);

                if (usersWaiting.length == 1) {
                    reinitialiserBtn.disabled = false;
                }
                
            } else {
                document.querySelector('#user_'+matricule).classList.remove("selected_user");
                usersWaiting.splice(index, 1)

                if (usersWaiting.length == 0) {
                    reinitialiserBtn.disabled = true;
                }
            }

            if (usersWaiting.length > 0) {
                cibleInput.value = usersWaiting.length+" personne(s).."
            } else {
                cibleInput.value = ""
            }
        }

        allUsers = document.querySelectorAll("[id^='user_']");
        function selectAll() {
            allUsers.forEach((user, k) => {
                if (user.style.display != "none") {
                    var matricule = user.id.split("_")[1];
                    var index = usersWaiting.indexOf(matricule);
                    if (index == -1) {
                        user.classList.add("selected_user");
                        usersWaiting.push(matricule);
                    }
                }
            });

            if (usersWaiting.length > 0) {
                cibleInput.value = usersWaiting.length+" personne(s).."
            } else {
                cibleInput.value = ""
            }
        }

        function reinitialiser() {
            if (confirm("Réinitialiser la liste des utilisateurs selectionné?")) {
                usersWaiting.forEach(matricule => {
                    document.querySelector('#user_'+matricule).classList.remove("selected_user");
                });
                usersWaiting = [];
                reinitialiserBtn.disabled = false;
                cibleInput.value = ""
            }
        }

        function submitBtn() {
            if (confirm("Confirmer?")) {
                document.getElementById("cible_array").value = JSON.stringify(usersWaiting);
                return true;
            } else {
                return false;
            }
        }
        </script>

        
<script src="/Assets/js/specific_search.js" tables ="modal_users"></script>
  </body>
  </html>
