<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {
        if (isset($_GET["id"])) {
            require_once("../../Classes/ParcoursDB.php");
            $parcoursDB = new ParcoursDB();
            $success = $parcoursDB->delete($_GET["id"]);
            $parcoursDB = null;

            header("location: /User/Directeur/Gestion/Parcours/index.php?m=". ($success == true? 1 : 0));
        }

        
        exit();
    }
    
    header("location: /index.php");
?>