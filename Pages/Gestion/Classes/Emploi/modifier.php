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
    //require_once(ROOT."/Classes/Roles.php");
    // require_once(ROOT."/Classes/Database/EmploiDB.php");
    // $emploiDB = new EmploiDB();
    // $emploi = $emploiDB->getAll($classeId); // byAnne
    // $emploiDB = null;
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
            <label for="class" class="lab_param">Class : </label>
            <select name="classes"  class="op" id="op_class">
                <option class="op_text" value="0">--none--</option>
                <option class="op_text" value="1">DSI3.2</option>
            </select>
        </div><br>

        <div class="form_cl" id="grp">
            <label for="group" class="lab_param">Group : </label>
            <select name="classes"  class="op" id="op_class">
                <option class="op_text" value="0">1</option>
            </select>
        </div>

        <!--the details of the form-->
        <div class="detail">
            
            <label for="matiere" class="detail_lab">Matiere</label>
            <select name="matiere" id="mat_op" class="detail_op">
                <option value="0">POO</option>
            </select>
            
            <label for="Salle" class="detail_lab">Salle</label>
            <select name="Salle" id="mat_op" class="detail_op">
                <option value="0">G003</option>
            </select>

            <label for="Prof" class="detail_lab">Prof</label>
            <select name="Prof" id="mat_op" class="detail_op">
                <option value="0">Mr.Mourad Hadhtri</option>
            </select>
            <br>
            <br>
            <br>
            <span style="margin-left: 20%;"></span>
            <label for="Seance" class="detail_lab">Seance</label>
            <select name="Seance" id="mat_op" class="detail_op">
                <option value="0">S3</option>
            </select>

            <label for="Jour" class="detail_lab">Jour</label>
            <select name="Jour" id="mat_op" class="detail_op">
                <option value="0">Lundi</option>
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
</body>
</html>