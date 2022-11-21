<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {

        if (isset($_GET["matiereId"]) && isset($_GET["matricule"]) && isset($_GET["planId"])) {

            require_once("../../../Classes/Database/EnseignantMatiereDB.php");
            $ensMatiereDB = new EnseignantMatiereDB();
            $ensMatiereDB->retirer($_GET["matricule"], $_GET["matiereId"]);
            $ensMatiereDB = null;

            header("location: /Pages/Gestion/PlanEtude/Matiere/Enseignants.php?matiereId=".$_GET["matiereId"]."&planId=".$_GET["planId"]);
        }

        
        exit();
    }
    
    header("location: /index.php");
?>