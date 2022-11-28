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

    <title><?= $authName ?> - Classe <?=$classe["nom"].".".$classe["numero"]?> - Liste d'etudiants </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/profil.css">
    <link rel="stylesheet" href="/Assets/css/tables.css">
    <link rel="stylesheet" href="/Assets/css/buttons.css">
</head>
<body>

<?php
    //require_once(ROOT."/Classes/Roles.php");



    require_once(ROOT."/Classes/Database/GroupeDB.php");
    $groupDB = new GroupeDB();
    $groupes = $groupDB->getAll($classeId);
    $countGroups = count($groupes);
    $groupDB = null;
?>

<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "go_back"> <a href="../index.php">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>

<div class="cd">
<div class="cadre">
    <h1> Tableau de groupes de la classe <?=$classe["nom"].".".$classe["numero"]?>: </h1>
    <div class = "cadre_header">
        <div class = "forms"></div>
        <div class = "_tool_buttons" style = "margin-right:0">

            <a><button class = "_btn _green_btn" style = "margin-right:0" onclick="ajouterGroupe()"> Ajouter un groupe </button></a>
        </div>
    </div>
    <table id ="table_" class="scrollable-table">
        <thead>
            <tr> 
                <th style = "width:20%"><span class = "table_header">Numero de group</span></th>
                <th style = "width:50%"><span class = "table_header">Nombre d'etudiants</span></th>
                <th><span class = "table_header">Actions</span></th>
            </tr>
        </thead>
        <tbody> 
            <?php
                foreach ($groupes as $groupe) {
                    echo "
                        <tr>
                            <td>".$groupe["numero"]."</td>
                            <td>".$groupe["nombreEtudiant"]."</td>
                            <td>
                                <a class = 'link_ref' href = '#' onclick='supprimerGroupe(".$groupe["id"].");'>Supprimer groupe</a>
                                <a class = 'link_ref' href = 'Etudiants/index.php?groupeId=".$groupe["id"]."' >Liste d'etudiants</a>
                            </td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>
</div>

<script>
        const countGroups = <?= $countGroups ?>;
        const classeId = <?= $classeId ?>;

        function ajouterGroupe() {
            if (confirm("Voulez-vous vraiment ajouter un group à cette classe?")) {
                window.location.href = "/Pipes/Classes/Groupes/add.php?numero="+(countGroups+1)+"&classeId="+classeId; // (0+1) % 2 = 1 // (1+1) % 2 = 0
            }
        }

        function supprimerGroupe(groupeId) {
            if (confirm("Voulez-vous vraiment supprimer ce groupe?")) {
                window.location.href = "/Pipes/Classes/Groupes/delete.php?groupeId="+groupeId+"&classeId="+classeId; // (0+1) % 2 = 1 // (1+1) % 2 = 0
            }
        }
    </script>
</body>
</html>