<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 3;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title><?= $authName ?> - Boite des messages </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>

<?php 
    require_once(ROOT."/Classes/Database/BoiteDB.php");
    $boiteDB = new BoiteDB();
    $messages = $boiteDB->getAllSent($user["matricule"]);
    $boiteDB = null;
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "go_back"> <a href="/Pages/User/index.php">Retourner</h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>

<div class="cd">
<div class="cadre" id = "cadre">
    <h1> Boite des messages: </h1>
    <div class = "cadre_header">
        
        <div class = "forms">
             <div>Naviger:   
                <select id="search_filter_form" class="drop_form" name="tabs" onchange="navigate()" >
                    <option value="1">Inbox</option>
                    <option value="2" selected>Sent</option>
                </select>
            </div>
            <div>Search:   
                <select id="search_filter_form" class="drop_form" name="role">
                    <option value="1">Classe</option>
                    <option value="2">Title</option>
                    <option value="3">Date</option>
                </select>
                <input id= "search_input" type="text" class="lab_in_txt" name = "CIN" placeholder = "something..." required>
                <button type = "button" class = "_btn search_btn" onclick="search()"> Search </button>
            </div> 
        </div>
        <div class = "_tool_buttons" style = "margin-right:0">
            <a  href="Messages/add.php"><button class = "_btn _green_btn" style = "margin-right:0"> Créer un nouveau message </button></a>
        </div>
    </div>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:30%"><span class = "table_header">Title</span></th>
                <th style = "width:30%"><span class = "table_header">Date</span></th>
                <th style = "width:10%"><span class = "table_header">Vues</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody> 
            <?php
                foreach ($messages as $message) {
                    echo "
                        <tr>
                            <td>".$message["title"]."</td>
                            <td>".$message["date_creation"]."</td>
                            <td>".$message["vues"]."</td>
                            <td>
                                <a class = 'link_ref' href = 'Messages/view.php?id=".$message['id']."&from=sent' >View</a>
                                <a class = 'link_ref' href = 'Messages/modify.php?id=".$message['id']."' >Modifier</a>
                                <a class = 'link_ref' href = '/Pipes/Boite/Messages/supprimer.php?id=".$message['id']."' onclick=\"return confirm('DELETION: Vous avez sûre de supprimer cette message?? CETTE ACTION EST PERMINANT!');\">Supprimer</a>
                            </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
</div>

<script src="/Assets/js/specific_search.js" tables ="cadre"></script>
<script>
    function navigate() {
        window.location.href = "/Pages/Gestion/Boite/inbox.php"
    }
</script>
</body>
</html>