<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {

        if (isset($_GET["groupeId"]) && isset($_GET["addArray"])) {
            $addArray = json_decode($_GET["addArray"]);

            require_once("../../../../Classes/Database/EtudiantGroupDB.php");
            $etdGroupDB = new EtudiantGroupDB();

            echo "Processing query...";
            foreach ($addArray as $matricule) {
                $etdGroupDB->insert($matricule, $_GET["groupeId"]);
            }

            $etdGroupDB = null;
            echo "Done.";
            header("location: /User/Directeur/Gestion/Classes/Groupes/Etudiants/index.php?groupeId=".$_GET["groupeId"]);
        }

        echo "Unset values.";
        exit();
    }
    
    header("location: /index.php");
?>