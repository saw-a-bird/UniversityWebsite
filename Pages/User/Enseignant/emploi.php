<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 3;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");

        require_once(ROOT."/Classes/Database/GlobalDB.php");
        $globalDB = new GlobalDB();
        $session = $globalDB->getSession();
        $globalDB = null;  

        $semestre = $session["numero"];
    ?>

    <title> <?=$user["nom"]. " ".$user["prenom"] ?> - Emploi de temps </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
    <link rel="stylesheet" href="/Assets/css/emploi.css">
    
    <style>
    
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
    </style>
</head>
<body>

<?php
    require_once(ROOT."/Classes/Database/EmploiDB.php");
    $emploiDB = new EmploiDB();
    $emploi = $emploiDB->getAllForEnseignant($user["matricule"], $semestre); // byAnne
    $emploiDB = null;

    // by group, by semestre
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
        var emplois =  <?= json_encode($emploi) ?>;

        function display() {
            for(var e in emplois) {
                v = emplois[e];
                document.getElementById("s"+ v["sceance"]+"-d"+v["jour"]).innerHTML =  "<p> T, "+v["matiere"]+", "+ v["salle"] +", " + v["classeNom"] + "."+ v["classeNumero"]+ " (G"+v["groupeNumero"]+")";
            }
        }
     
        display()
    </script>

<script>
        divToPrint = document.getElementById("printable_table");

        function print_page() {

            var newWin = window.open(
                            "http://isetso.local/",
                            document.title,
                            "width=420,height=230,resizable,scrollbars=yes,status=1"
                            )
            newWin.document.write("<h1> "+document.title+"</h1>");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
</body>
</html>