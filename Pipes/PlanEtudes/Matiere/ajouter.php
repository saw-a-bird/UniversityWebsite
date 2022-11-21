<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {
        
        if (isset($_GET["matiereId"]) && isset($_GET["addArray"]) && isset($_GET["planId"])) {
            $addArray = json_decode($_GET["addArray"]);

            require_once("../../../Classes/Database/EnseignantMatiereDB.php");
            $ensMatiereDB = new EnseignantMatiereDB();

            echo "Processing query...";
            foreach ($addArray as $matricule) {
                $ensMatiereDB->insert($matricule, $_GET["matiereId"]);
            }

            $ensMatiereDB = null;
            echo "Done.";
            header("location: /Pages/Gestion/PlanEtude/Matiere/Enseignants.php?matiereId=".$_GET["matiereId"]."&planId=".$_GET["planId"]);
        }

        echo "Unset values.";
        exit();
    }
    
    header("location: /index.php");
?>