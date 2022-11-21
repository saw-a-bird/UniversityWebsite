<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {
        if (isset($_GET["id"]) && isset($_GET["planId"])) {
            require_once("../../Classes/Database/MatiereDB.php");
            $matiereDB = new MatiereDB();
            $success = $matiereDB->delete($_GET["id"]);
            $matiereDB = null;

            header("location: /Pages/Gestion/PlanEtude/afficher.php?id=".$_GET["planId"]);
        }

        
        exit();
    }
    
    header("location: /index.php");
?>