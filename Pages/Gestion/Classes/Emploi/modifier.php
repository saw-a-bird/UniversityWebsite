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
    ?>



    <title><?= $authName ?> - Classe <?=$classe["nom"].".".$classe["numero"]?> - Gérer l'emploi </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
    <link rel="stylesheet" href="/Assets/css/general.css">


    <link rel="stylesheet" href="/Assets/css/emploi.css">
</head>
<body>

<?php
    require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/EmploiDB.php");
    $emploiDB = new EmploiDB();
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
            <h3 class = "go_back"> <a href="/Pages/User/index.php">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>

    <!--the form-->
    <div >
    <form action="" method="post" >
        <!--the options of class and group-->
        <div class="form_cl">
            <div>
                <div class = "label_container"><label for="class" class="lab_param">Class : </label></div>
                <select name="classes"  class="op" id="op_class" disabled>
                    <option class="op_text"><?=$classe["nom"].".".$classe["numero"]?></option>
                </select>
            </div>

            <div style = "margin-top: 10px">
                <div class = "label_container"><label for="group" class="lab_param" onchange="byGroup(this.value);">Group : </label></div>
                <select name="classes"  class="op" id="op_class">
                    <?php
                        require_once(ROOT."/Classes/Database/GroupeDB.php");
                        $groupDB = new GroupeDB();
                        $groups = $groupDB->getAllSimple($classeId);
                        foreach ($groups as $row) {
                            echo "<option value='".$row["id"]."'>".$row["numero"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div style = "margin-top: 10px">
                <div class = "label_container"><label for="semestre" class="lab_param" onchange="bySemestre(this.value);">Semestre : </label></div>
                <select name="semesters"  class="op" id="op_class">
                    <option class="op_text" value="1">1</option>
                    <option class="op_text" value="2">2</option>
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
                    <label for="Salle" class="detail_lab">Salle</label>
                    <select name="Salle" id="mat_op" class="detail_op">
                    <?php
                            require_once(ROOT."/Classes/Database/SalleDB.php");
                            $salleDB = new SalleDB();
                            $salles = $salleDB->getAll();
                            foreach ($salles as $row) {
                                echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
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
            <br>
            <br>
            <span style="margin-left: 20%;"></span>
            <label for="seance" class="detail_lab">Seance</label>
            <select name="seance" id="sceance_op" class="detail_op">
                <option value="0">S1</option>
                <option value="1">S2</option>
                <option value="2">S3</option>
                <option value="3">S4</option>
                <option value="4">S5</option>
                <option value="5">S6</option>
            </select>

            <label for="jour" class="detail_lab">Jour</label>
            <select name="jour" id="ju_op" class="detail_op">
                <option value="0">Lundi</option>
                <option value="1">Mardi</option>
                <option value="2">Mercredi</option>
                <option value="3">Jeudi</option>
                <option value="4">Vendredi</option>
                <option value="5">Samedi</option>
            </select>
            <br>
            <!--button Submit-->
            <button type="submit" class="b_sub" >Submit</button>
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
        <table> 
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
                <th class="colum mid">S1<br>8:30<br>10:00</th>
                <th class="colum mid" id="s1-l"></th>
                <th class="colum mid" id="s2-l"></th>
                <th class="colum mid" id="s3-l"></th>
                <th class="colum mid" id="s4-l"></th>
                <th class="colum mid" id="s5-l"></th>
                <th class="colum mid" style="border-right: 0px;" id="s6-l"></th>
            </tr>

            <!--the 3rd row S2-->   
            <tr class="row_tab">
                <th class="colum mid" id="s1-mar">S2<br>10:05<br>11:35</th>
                <th class="colum mid" id="s2-mar"></th>
                <th class="colum mid" id="s3-mar"></th>
                <th class="colum mid" id="s4-mar"></th>
                <th class="colum mid" id="s5-mar"></th>
                <th class="colum mid" id="s6-mar"></th>
                <th class="colum mid" style="border-right: 0px;"></th>
            </tr>

            <!--the 4th row S3-->   
            <tr class="row_tab ">
                <th class="colum mid" id="s1-merc">S3<br>11:40<br>13:10</th>
                <th class="colum mid" id="s2-merc"></th>
                <th class="colum mid" id="s3-merc"></th>
                <th class="colum mid" id="s4-merc"></th>
                <th class="colum mid" id="s5-merc"></th>
                <th class="colum mid" id="s6-merc"></th>
                <th class="colum mid" style="border-right: 0px;"></th>
            </tr>

            <!--the 5th row S4-->   
            <tr class="row_tab">
                <th class="colum mid" id="s1-j">S4<br>13:15<br>14:45</th>
                <th class="colum mid" id="s2-j"></th>
                <th class="colum mid" id="s3-j"></th>
                <th class="colum mid" id="s4-j"></th>
                <th class="colum mid" id="s5-j"></th>
                <th class="colum mid" id="s6-j"></th>
                <th class="colum mid" style="border-right: 0px;"></th>
            </tr>

            <!--the 6th row S5-->   
            <tr class="row_tab">
                <th class="colum mid" id="s1-v">S5<br>14:50<br>16:20</th>
                <th class="colum mid" id="s2-v"></th>
                <th class="colum mid" id="s3-v"></th>
                <th class="colum mid" id="s4-v"></th>
                <th class="colum mid" id="s5-v"></th>
                <th class="colum mid" id="s6-v"></th>
                <th class="colum mid" style="border-right: 0px;"></th>
            </tr>

            <!--the 7th row S6-->   
            <tr class="row_tab">
                <th class="colum mid" style="border-bottom: 0px;" id="s1-s">S6<br>16:25<br>17:55</th>
                <th class="colum mid" style="border-bottom: 0px;" id="s2-s"></th>
                <th class="colum mid" style="border-bottom: 0px;" id="s3-s"></th>
                <th class="colum mid" style="border-bottom: 0px;" id="s4-s"></th>
                <th class="colum mid" style="border-bottom: 0px;" id="s5-s"></th>
                <th class="colum mid" style="border-bottom: 0px;" id="s6-s"></th>
                <th class="colum "></th>
            </tr>
        </table>
    </div>

    <script>
        var emplois =  <?= json_encode($emploi) ?>;
        var matiereEns = <?= json_encode($matiereEns) ?>;
        var selectedSemestre = 1
        var selectedGroup = <?= count($groups) > 0 ? 1 : 0 ?>;

        function ByGroup(group) {
            selectedGroup = group
            display()
        }

        function BySemestre(semester) {
            selectedSemestre = semester
            display()
        }

        function display(filtered_items) {
            // stuff here
        }

        var selectMatiere = document.getElementById("mat_op")
        var selectEnseignant = document.getElementById("prof_op")
        function changerEnseignants(matiere, remove = true) {
            if (remove == true)
                removeOptions(selectEnseignant)

            if (matiereEns[matiere] != undefined) {
                matiereEns[matiere].forEach((v) => {
                    var option = document.createElement("option");
                    option.value = v["id"]; 
                    option.text = v["nomprenom"];
                    selectEnseignant.add(option);
                })
            }
        }

        function removeOptions(selectElement) {
            var i, L = selectElement.options.length - 1;
            for(i = L; i >= 0; i--) {
                selectElement.remove(i);
            }
        }

        changerEnseignants(selectMatiere.value)
    </script>
</body>
</html>