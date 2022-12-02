<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {

        if (isset($_GET["id"])) {
            require_once("../../../Classes/Database/EmploiDB.php");
            $emploiDB = new EmploiDB();
            $success = $emploiDB->delete($_GET["id"]);
            $emploiDB = null;

            header("location: /Pages/Gestion/Classes/Emploi/modifier.php?classeId=".$_GET["classe"]."&semestre=".$_GET["semestre"]."&group=". $_GET["group"]);
        }
        
        exit();
    }
    
    header("location: /index.php");
?>