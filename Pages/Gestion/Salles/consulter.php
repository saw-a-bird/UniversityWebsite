<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 3;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Salles </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">

    <style>
        .filtre_btn {
            border-color: #858585;
            color: #595959;
            padding: 6px 10px 3px;
            background-color: rgb(239 239 239);
        }

        .detail_lab {
            font-size: 16px;
        }
    </style>
</head>
<body>

<?php
    //require_once(ROOT."/Classes/Roles.php");
    require_once(ROOT."/Classes/Database/SalleDB.php");
    $salleDB = new SalleDB();


    if (isset($_GET["sceance"]) && isset($_GET["jour"])) {
        $filterBy = "ALL";
        $byJour = $_GET["jour"];
        $bySceance = $_GET["sceance"];
    } else {
        $bySceance = 1;
        $byJour = 1;
    }

    $salles = $salleDB->getFilteredByAll($bySceance, $byJour);
    
    $salleDB = null;
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

<div class="cd">
<div class="cadre" id = "cadre">
    <h1> Tableau de salles: </h1>
    <div class = "cadre_header">
        <div class = "forms">
            <div>Disponibilité par :  
                 <div style = "display: inline-block; margin-left: 10px">  
                    <label for="jour" class="detail_lab">Jour</label>
                    <select name="jour" id="jour_op" class="drop_form">
                        <option value="1">Lundi</option>
                        <option value="2">Mardi</option>
                        <option value="3">Mercredi</option>
                        <option value="4">Jeudi</option>
                        <option value="5">Vendredi</option>
                        <option value="6">Samedi</option>
                    </select>
                </div>
                <div style = "display: inline-block; margin-left: 10px">   
                    <label for="sceance" class="detail_lab">Sceance</label>
                    <select name="sceance" id="sceance_op" class="drop_form">
                        <option value="1">Sceance 1</option>
                        <option value="2">Sceance 2</option>
                        <option value="3">Sceance 3</option>
                        <option value="4">Sceance 4</option>
                        <option value="5">Sceance 5</option>
                        <option value="6">Sceance 6</option>
                    </select>
                </div>
                    
                <button type = "button" class = "_btn filtre_btn" onclick="filtre()"> Filtrer </button>            
            </div> 
            <div style = "margin-top:15px">Search:   
                <select id="search_filter_form" class="drop_form" name="role" style = "display:none">
                    <option value="1"></option>
                </select>
                <label for="jour" class="detail_lab">Nom de salle: </label>
                <input id= "search_input" type="text" class="drop_form" style = "height: 22px;" name = "salle" placeholder = "something..." required>
                <button type = "button" class = "_btn search_btn" onclick="search()"> Search </button>
            </div> 
        </div>
    </div>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:60%"><span class = "table_header">Nom</span></th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($salles as $salle) {
                    echo "
                        <tr>
                            <td >".$salle["nom"]."</td>";
                           

                        echo "</tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
</div>

<script>
    jour_op = document.getElementById("jour_op");
    sceance_op = document.getElementById("sceance_op");

    var jour = <?= $byJour ?>;
    jour_op.options[jour-1].selected = true;

    var sceance = <?= $bySceance ?>;
    sceance_op.options[sceance-1].selected = true;

    function filtre() {
        var root = "/Pages/Gestion/Salles/consulter.php";
        window.location.href = root+"?jour="+(jour_op.selectedIndex+1)+"&sceance="+(sceance_op.selectedIndex+1);
    }
</script>
<script src="/Assets/js/specific_search.js" tables ="cadre"></script>
</body>
</html>




