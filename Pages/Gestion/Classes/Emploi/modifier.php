<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");

        $classeId = $_GET["classeId"];

        require_once(ROOT."/Classes/Database/ClasseDB.php");
        $classeDB = new ClasseDB();
        $classe = $classeDB->get($classeId);
        $classeDB = null;  

        require_once(ROOT."/Classes/Database/GroupeDB.php");
        $groupDB = new GroupeDB();
        $groups = $groupDB->getAllSimple($classeId);
    ?>

    <title><?= $authName ?> - Classe <?=$classe["nom"].".".$classe["numero"]?> - Gérer l'emploi </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
    <link rel="stylesheet" href="/Assets/css/emploi.css">
    
    <style>
       @media print{@page {size: landscape}}
        .delete_x {
            color:red;
            margin-left: 5px
        }
        

        .delete_x:hover, .enseignant_x:hover {
            font-weight:bold;
        }

        .emploi_sc {
            font-size:18px;
            text-align: left;
        }
        .emploi_row {
            padding-left:10px;
            color:black;
            font-size:15px;
            text-align: left;
            vertical-align: top;
            min-width: 150px;
            max-width: 150px;
        }

        .emploi_row > p {
            margin-top:1px;
            margin-bottom:2px
                
        }

        .green_alert {
            font-weight: bold;
            margin: 0 auto 20px;
            color:green;
        }
        
        .red_alert {
            font-weight: bold;
            margin: 0 auto 20px;
            color:red;
        }

        .red_alert, .green_alert {
            margin-bottom: -23px;
            text-align: center;
            margin-top: 17px;
        }
    </style>
</head>
<body>

<?php
    $message = "";
    
    require_once(ROOT."/Classes/Database/EmploiDB.php");
    $emploiDB = new EmploiDB();
    
    if (isset($_POST["confirm_btn"])) {
        if (isset($_POST["semestre"])) {
            $semestreCurrent = $_POST["semestre"];
        }

        if (isset($_POST["groupe"])) {
            $groupeCourant = $_POST["groupe"];
        }

        if (isset($_POST["semestre"]) && isset($_POST["jour"]) && isset($_POST["sceance"]) && 
        isset($_POST["groupe"]) && isset($_POST["matiere"]) && isset($_POST["salle"]) && 
        isset($_POST["enseignant"]) && $_POST["enseignant"] != -1 && $_POST["matiere"] != -1 && $_POST["salle"] != -1) {
            $semestre = $_POST["semestre"]; $jour = $_POST["jour"]; $sceance = $_POST["sceance"]; $groupeId = $_POST["groupe"]; $matiereId = $_POST["matiere"]; $salle = $_POST["salle"]; $enseignant = $_POST["enseignant"];

            $sceanceExists = $emploiDB->exists($classe["anne"], $semestre, $jour, $sceance, $salle); // par session implicitment

            $save = false;
            if ($sceanceExists != false) { // nothing was found
                $save = true;
                foreach ($sceanceExists as $sceanceE) { 
                    if ($sceanceE["classeId"] == $classeId) {
                       if ($sceanceE["groupeId"] == $groupeId) {
                            $grp = $groupDB->get($groupeId);
                            $message = "<p class = 'red_alert'>La groupe (#".$grp["groupeNumero"].") déja avoir cette sceance!</p>";
                            $save = false;
                            break;
                       }
                    } else {
                        $message = "<p class = 'red_alert'>Une sceance déja existe dans cet position (classe: <a href = 'modifier.php?classeId=".$sceance["classeId"]."'>#".$sceance["classeId"]."</a>)!</p>";
                        $save = false;
                        break;
                    }
                }
            } else {
                $save = true;
            }

            if ($save == true) {
                $emploiDB->insert($groupeId, $semestre, $jour, $sceance, $salle, $matiereId, $enseignant);
                $message = "<p class = 'green_alert'>La sceance est ajouté avec succes.</p>"; 
            }

        } else {
            $message = "<p class = 'red_alert'>La formulaire est erroné</p>";
        }
    } else {
        $semestreCurrent = 1; // default
        if (isset($_GET["semestre"]) && $_GET["group"]) {
            $groupeCourant = $_GET["group"];
            $semestreCurrent = $_GET["semestre"];
        }

        $groupeCourant = null;
        if (count($groups) > 0) {
            $groupeCourant = $groups[0]["id"];
        }
    } 

    $emploi = $emploiDB->getAll($classeId); // byAnne
    $emploiDB = null;
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "print_page"> <a onclick = "print_page()">Imprimer </a></h3>
            <h3 class = "go_back"> <a href="/Pages/User/index.php">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>

    <!--the form--> 
<div>
    <form action="" method="post" >
        <!--the options of class and group-->
        <div class="form_cl">
            <div>
                <div class = "label_container"><label for="class" class="lab_param">Class : </label></div>
                <select name="classe" class="op" id="op_class" disabled>
                    <option class="op_text" id = "classe_nom"><?=$classe["nom"].".".$classe["numero"]?></option>
                </select>
            </div>

            <div style = "margin-top: 10px">
                <div class = "label_container"><label for="group" class="lab_param" >Group : </label></div>
                <select name="groupe" class="op" id="op_group">
                    <?php

                        foreach ($groups as $row) {
                            echo "<option value='".$row["id"]."' ".( $groupeCourant == $row["id"]? "selected": "").">".$row["numero"]."</option>";
                        }
 
                    ?>
                </select>
            </div>
            <div style = "margin-top: 10px">
                <div class = "label_container"><label for="semestre" class="lab_param">Semestre : </label></div>
                <select name="semestre" class="op" id="op_semestre">
                    <option class="op_text" value="1">1</option>
                    <option class="op_text" value="2" <?= $semestreCurrent == 2? "selected": "" ?>>2</option>
                </select>
            </div>
        </div><br>



        <!--the details of the form-->
        <div class="detail">
            <div style = "justify-content: space-evenly; display: flex;">
                <div style = "display: inline-block;">
                    <label for="matiere" class="detail_lab">Matiere</label>
                    <select name="matiere" id="mat_op" class="detail_op" onchange="changerEnseignants(this.value);">
                        <?php
                            require_once(ROOT."/Classes/Database/MatiereDB.php");
                            $matiereDB = new MatiereDB();

                            require_once(ROOT."/Classes/Database/EnseignantMatiereDB.php");
                            $ensMatiereDB = new EnseignantMatiereDB();

                            $matieres = $matiereDB->getByPlanEtd($classe["planEtudeID"]);
                            $matiereEns = [];
                            
                            foreach ($matieres as $row) {
                                $matiereId = $row["id"];
                                $matiereEns[$matiereId] = $ensMatiereDB->getAll($matiereId);
                                echo "<option value='$matiereId'>".$row["nom"]."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div style = "display: inline-block;">  
                    <label for="enseignant" class="detail_lab">Prof</label>
                    <select name="enseignant" id="prof_op" class="detail_op">
                    </select>
                </div>

            </div>
            <br/>
            <br>
            <div style = "justify-content: space-evenly; display: flex;">

                <div style = "display: inline-block;">  
                    <label for="sceance" class="detail_lab">Sceance</label>
                    <select name="sceance" id="sceance_op" class="detail_op">
                        <option value="1">Seance 1</option>
                        <option value="2">Seance 2</option>
                        <option value="3">Seance 3</option>
                        <option value="4">Seance 4</option>
                        <option value="5">Seance 5</option>
                        <option value="6">Seance 6</option>
                    </select>
                </div>
                
                <div style = "display: inline-block;">  
                    <label for="jour" class="detail_lab">Jour</label>
                    <select name="jour" id="ju_op" class="detail_op">
                        <option value="1">Lundi</option>
                        <option value="2">Mardi</option>
                        <option value="3">Mercredi</option>
                        <option value="4">Jeudi</option>
                        <option value="5">Vendredi</option>
                        <option value="6">Samedi</option>
                    </select>
                </div>
                <div style = "display: inline-block;">
                
                    <label for="salle" class="detail_lab">Salle</label>
                    <select name="salle" id="salle_op" class="detail_op">
                    <?php
                            require_once(ROOT."/Classes/Database/SalleDB.php");
                            $salleDB = new SalleDB();
                            $salles = $salleDB->getAll();
                            foreach ($salles as $row) {
                                echo "<option value='".$row["nom"]."'>".$row["nom"]."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <!--button Submit-->
            
            <?= ($message != null ? $message : '') ?>
            <button type="submit" class="b_sub" name = "confirm_btn">Submit</button>
        </div>
    </form>
    </div>   

    <!--the table-->
    <!--the cases are idied by the following system 
        s1-l .. s6-l for mondays
        s1-mar .. s6-mar thuesdays
        s1-merc .. s6-merc wednesdays
        s1-j .. s6-j for thursdays
        s1-v .. s6-v for fridays
        s1-s .. s6-s for saturdays 
    -->
    <div class="cont_table">
        <table border='1' cellpadding='1' id='printable_table' >
            <!--the first row-->   
            <tr class="row_tab ">
                <th class="colum first"> </th>
                <th class="colum first">Lundi</th>
                <th class="colum first">Mardi</th>
                <th class="colum first">Mercredi</th>
                <th class="colum first">Jeudi</th>
                <th class="colum first">Vendredi</th>
                <th class="colum first" style="border-right:0px ;">Samedi</th>
            </tr>
            <!--the 2nd row S1-->   
            <tr class="row_tab">
                <th class="colum mid emploi_sc">S1<br>08:30<br>10:00</th>
                <th class="colum mid emploi_row" id="s1-d1"></th>
                <th class="colum mid emploi_row" id="s1-d2"></th>
                <th class="colum mid emploi_row" id="s1-d3"></th>
                <th class="colum mid emploi_row" id="s1-d4"></th>
                <th class="colum mid emploi_row" id="s1-d5"></th>
                <th class="colum mid emploi_row" id="s1-d6" style="border-right: 0px;"></th>
            </tr>

            <!--the 3rd row S2-->   
            <tr class="row_tab">
                <th class="colum mid emploi_sc">S2<br>10:05<br>11:35</th>
                <th class="colum mid emploi_row" id="s2-d1"></th>
                <th class="colum mid emploi_row" id="s2-d2"></th>
                <th class="colum mid emploi_row" id="s2-d3"></th>
                <th class="colum mid emploi_row" id="s2-d4"></th>
                <th class="colum mid emploi_row" id="s2-d5"></th>
                <th class="colum mid emploi_row" id="s2-d6" style="border-right: 0px;"></th>
            </tr>

            <!--the 4th row S3-->   
            <tr class="row_tab ">
                <th class="colum mid emploi_sc">S3<br>11:40<br>13:10</th>
                <th class="colum mid emploi_row" id="s3-d1"></th>
                <th class="colum mid emploi_row" id="s3-d2"></th>
                <th class="colum mid emploi_row" id="s3-d3"></th>
                <th class="colum mid emploi_row" id="s3-d4"></th>
                <th class="colum mid emploi_row" id="s3-d5"></th>
                <th class="colum mid emploi_row" id="s3-d6"style="border-right: 0px;"></th>
            </tr>

            <!--the 5th row S4-->   
            <tr class="row_tab">
                <th class="colum mid emploi_sc">S4<br>13:15<br>14:45</th>
                <th class="colum mid emploi_row" id="s4-d1"></th>
                <th class="colum mid emploi_row" id="s4-d2"></th>
                <th class="colum mid emploi_row" id="s4-d3"></th>
                <th class="colum mid emploi_row" id="s4-d4"></th>
                <th class="colum mid emploi_row" id="s4-d5"></th>
                <th class="colum mid emploi_row" id="s4-d6"style="border-right: 0px;"></th>
            </tr>

            <!--the 6th row S5-->   
            <tr class="row_tab">
                <th class="colum mid emploi_sc">S5<br>14:50<br>16:20</th>
                <th class="colum mid emploi_row" id="s5-d1"></th>
                <th class="colum mid emploi_row" id="s5-d2"></th>
                <th class="colum mid emploi_row" id="s5-d3"></th>
                <th class="colum mid emploi_row" id="s5-d4"></th>
                <th class="colum mid emploi_row" id="s5-d5"></th>
                <th class="colum mid emploi_row" id="s5-d6"style="border-right: 0px;"></th>
            </tr>

            <!--the 7th row S6-->   
            <tr class="row_tab">
                <th class="colum mid emploi_sc" style="border-bottom: 0px;">S6<br>16:25<br>17:55</th>
                <th class="colum mid emploi_row" id="s6-d1" style="border-bottom: 0px;" ></th>
                <th class="colum mid emploi_row " id="s6-d2" style="border-bottom: 0px;"></th>
                <th class="colum mid emploi_row" id="s6-d3" style="border-bottom: 0px;" ></th>
                <th class="colum mid emploi_row" id="s6-d4"  style="border-bottom: 0px;"></th>
                <th class="colum mid emploi_row" id="s6-d5" style="border-bottom: 0px;"></th>
                <th class="colum emploi_row" id="s6-d6"></th>
            </tr>
        </table>
    </div>

    <script>
        var classeId =  <?= $classeId ?>;
        var emplois =  <?= json_encode($emploi) ?>;
        var allRows =  document.querySelectorAll(".emploi_row")
        var matiereEns = <?= json_encode($matiereEns) ?>;
        var selectedSemestre =<?= $semestreCurrent ?>;
        var selectedGroup = <?= $groupeCourant ?>;
        
        function ByGroup(group) {
            selectedGroup = group
            display()
        }

        function BySemestre(semester) {
            selectedSemestre = semester
            display()
        }

        function display(remove = true) {
            // clear
            if (remove == true) {
                allRows.forEach((v, k) => {
                    v.innerHTML = "";
                })
            }

            console.log("group: "+selectedGroup);
            console.log("semestre: "+selectedSemestre);
            
            // filtre then display what's left
            for(var e in emplois) {
                console.log(JSON.stringify(emplois[e]))
                v = emplois[e];
                if (v["semestre"] == selectedSemestre && v["groupe"] == selectedGroup) {
                    document.getElementById("s"+ v["sceance"]+"-d"+v["jour"]).innerHTML =  "<p> T, "+v["matiere"]+", "+ v["salle"] +", " + v["enseignant"] + 
                    "<a class = 'delete_x' href = '/Pipes/Classes/Emplois/deleteitem.php?id="+ v["id"] + "&semestre="+ selectedSemestre +"&group="+ selectedGroup +"&classe="+classeId+"'>(Supprimer)</a>";
                }
            }
            // display
        }

        var selectMatiere = document.getElementById("mat_op")
        var selectEnseignant = document.getElementById("prof_op")

        function changerEnseignants(matiere, remove = true) {
            if (remove == true)
                removeOptions(selectEnseignant)

            if (matiereEns[matiere] != undefined && matiereEns[matiere].length > 0) {
                selectEnseignant.disabled = false
                matiereEns[matiere].forEach((v) => {
                    var option = document.createElement("option");
                    option.value = v["matricule"]; 
                    option.text = v["nomprenom"];
                    selectEnseignant.add(option);
                })
            } else {
                notFound(selectEnseignant)
            }
        }

        function removeOptions(selectElement) {
            var i, L = selectElement.options.length - 1;
            for(i = L; i >= 0; i--) {
                selectElement.remove(i);
            }
        }

        function notFound(select) {
            var option = document.createElement("option");
            option.value = "-1"; 
            option.text = "Aucune trouvé...";
            select.add(option);
            select.disabled = true
        }

        var sallesExist = <?= count($salles) > 0 ?>;
        if (sallesExist == false) {
            notFound(document.getElementById("salle_op"))
        }

        var matieresExists = <?= count($matieres) > 0 ?>;
        if (matieresExists) {
            changerEnseignants(selectMatiere.value)
        } else {
            notFound(selectEnseignant)
            notFound(selectMatiere)
        }
            
        display(false)

        var semestreOp = document.getElementById("op_semestre");
        semestreOp.onchange = function(){
            BySemestre(this.value);
        }

        var groupeOp = document.getElementById("op_group");
        groupeOp.onchange = function(){
            ByGroup(this.value);
        }
    </script>

    <script>
        divToPrint = document.getElementById("printable_table");

        function print_page() {
            deletebtns = document.querySelectorAll(".delete_x");
            deletebtns.forEach((v, k) => {
                v.style.display = "none"
            })

            className = document.getElementById("classe_nom").innerHTML+ " G"+ groupeOp.options[groupeOp.selectedIndex].text+" (Semestre "+semestreOp.options[semestreOp.selectedIndex].text+")";
            var newWin = window.open(
                            "http://isetso.local/",
                            "Emploi de temps - "+className,
                            "width=420,height=230,resizable,scrollbars=yes,status=1"
                            )
            newWin.document.write('<html><head>');
            newWin.document.write("<h1> Emploi de temps - "+className+"</h1>");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();

            deletebtns.forEach((v, k) => {
                v.style.display = ""
            })
        }
    </script>
</body>
</html>