<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 2;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    
    ?>

    <title><?= $authName ?> - Plan Etude</title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
    
    <style>

        /* * {
            font-size: 14px;
        } */

        tr > th {
            border: 1px solid rgb(206, 140, 41);
        }

        #table_ > thead {
            border-bottom: none;
        }

        td {
            border: 1px solid rgb(206, 140, 41);
            height:20px
        }

        .table_header {
            font-size:17px
        }
        .table_inner {
            font-size:15px
        } 
        td {
            font-size: 16px !important;
        }

        .delete_x {
            color:red
        }
        

        .delete_x:hover, .enseignant_x:hover {
            font-weight:bold;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $planId = $_GET["id"];
            require_once(ROOT."/Classes/Database/PlanEtudeDB.php");
            $planEtudeDB = new PlanEtudeDB();

            if ($planEtudeDB->exists($planId)) {
                $planEtudeDB = null;
                require_once(ROOT."/Classes/Database/UniteDB.php");
                $uniteDB = new UniteDB();

                require_once(ROOT."/Classes/Database/MatiereDB.php");
                $matiereDB = new MatiereDB();
            
            } else {
                header("location: index.php");
            }
        } else {
            header("location: index.php");
        }
        
        
    ?>

    <div class="logo">  
        <div class = "seperated_div">
            <div class = "header_div">
                <img src="/Assets/imgs/LOGO.png">
                <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
            </div>
            <div class = "buttons_div">
                <h3 class = "go_back"> <a href="index.php">Retourner</a></h3>
                <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
            </div>
        </div>
    </div>

    <div class="cd">
        <div class="cadre" >
        <h1 class = "table_name"> Plan etude #<?= $planId ?>: </h1>
            <div class = "cadre_header">
                <div class = "forms">

                </div>

                <div class = "_tool_buttons">
                    <a href = "Unite/ajouter.php?planId=<?= $planId ?>"><button class = "_btn _green_btn"> Ajouter un unite </button></a>
                    <a href = "Matiere/ajouter.php?planId=<?= $planId ?>"><button class = "_btn _green_btn"> Ajouter un matiere </button></a>
                </div>
            </div>
            <table id="table_" class="scrollable-table">
            <thead>
                <tr>
                    <th rowspan="2" style="width:1%"><span class="table_header">Semestre</span></th>
                    <th rowspan="2" style="width:10%"><span class="table_header">Type</span></th>
                    <th rowspan="2" style="width:20%"><span class="table_header">Unite</span></th>
                    <th rowspan="2" style="width:25%"><span class="table_header">Matiere</span></th>
                    <th colspan="4" style="width:25%"><span class="table_header">Volume horaire semestriel</span>
                    </th>
                    <th colspan="2"><span class="table_header">Credit</span>
                    <th colspan="2"><span class="table_header">Coefficient</span>
                </tr>
                <tr>
                    <th class="table_inner"><span>Global</span></th>
                    <th class="table_inner"><span>Cours</span></th>
                    <th class="table_inner"><span>TD</span></th>
                    <th class="table_inner"><span>TP</span></th>
                    <th class="table_inner"><span>ECUE</span></th>
                    <th class="table_inner"><span>UE</span></th>
                    <th class="table_inner"><span>ECUE</span></th>
                    <th class="table_inner"><span>UE</span></th>
                </tr>
            </thead>
            <tbody class = "unpadded">
            <?php
                    for ($sem = 1; $sem <= 2; $sem++) { 
                        echo"<tr>
                                <td id = 's$sem'> S".$sem."</td>
                            </tr>";
                        
                        $unites = $uniteDB->getAllBySemestre($planId, $sem);
                        $semestreCount = 1;
                        foreach ($unites as $i => $unite) {  
                            $matieres = $matiereDB->getAll($unite["id"]);
                            $matieresCount = count($matieres) + 1;
                            $semestreCount++;
                            echo "
                            <tr>
                                <td rowspan='$matieresCount' class = 'table_type'> ".$unite["type"]." </td>
                                <td rowspan='$matieresCount' class = 'table_normal'> ".$unite["nom"]." 
                                    <a class = 'delete_x' href = '/Pipes/PlanEtudes/Unite/delete.php?planId=$planId&id=". $unite["id"] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer cette UNITE???? ".count($matieres)." matieres seront supprimé!')\"> (Supprimer)</a>
                                </td>
                            </tr>";
                            
                            $creditMatiere = 0;
                            $coeffMatiere = 0;
                            foreach ($matieres as $index => $matiere) {  
                            $semestreCount++;
                            $creditMatiere += (float) $matiere["credit_mat"];
                            $coeffMatiere += (float) $matiere["coefficient_mat"];
                            echo
                            "<tr>
                                <td rowspan='1' class = 'table_normal'>".$matiere["nom"]." 
                                <a class = 'enseignant_x' href = 'Matiere/Enseignants.php?planId=$planId&matiereId=". $matiere["id"] . "'> (Enseignants)</a>
                                <a class = 'delete_x' href = '/Pipes/PlanEtudes/Matiere/delete.php?planId=$planId&id=". $matiere["id"] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer cette MATIERE????')\"> (Supprimer)</a> 
                                </td>
                                <td rowspan='1'><span>".(($matiere["heursCours"] + ($matiere["heursCours"]/2) + $matiere["heursTP"])*14)."</span></td>
                                
                                <td rowspan='1'>".((float) $matiere["heursCours"])."</td>
                                <td rowspan='1'>".($matiere["heursCours"]/2)."</td>
                                <td rowspan='1'>".((float) $matiere["heursTP"])."</td>
                                <td rowspan='1'>".((float) $matiere["credit_mat"])."</td>";
                                if ($index == 0)
                                    echo"<td id = 'credit_$i' rowspan='".($matieresCount - 1)."'></td>";
                                echo "<td rowspan='1'>".((float) $matiere["coefficient_mat"])."</td>";
                                if ($index == 0)
                                    echo"<td id = 'coeff_$i' rowspan='".($matieresCount - 1)."'></td>";
                                echo "

                            </tr>
                        
                            <script type=\"text/javascript\">
                                document.getElementById('credit_$i').innerHTML = '$creditMatiere';
                                document.getElementById('coeff_$i').innerHTML = '$coeffMatiere';
                            </script>";
                            }
                        }

                        echo "</tr>
                        
                        <script type=\"text/javascript\">
                            document.getElementById('s$sem').rowSpan = '$semestreCount';
                        </script>";
                    }
                ?>
            </table>
        </div>
    </div>
 
</body>
</html>