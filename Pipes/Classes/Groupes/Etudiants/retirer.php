<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {

        if (isset($_GET["groupeId"]) && isset($_GET["matricule"])) {

            require_once("../../../../Classes/Database/EtudiantGroupDB.php");
            $etdGroupDB = new EtudiantGroupDB();
            $etdGroupDB->retirer($_GET["matricule"], $_GET["groupeId"]);
            $etdGroupDB = null;

            header("location: /User/Directeur/Gestion/Classes/Groupes/Etudiants/index.php?groupeId=".$_GET["groupeId"]);
        }

        
        exit();
    }
    
    header("location: /index.php");
?>