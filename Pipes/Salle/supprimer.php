<?php
    session_start();
    $securityRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {
        if (isset($_GET["nom"])) {
            require_once("../../Classes/Database/SalleDB.php");
            $salleDB = new SalleDB();
            $success = $salleDB->delete($_GET["nom"]);
            $salleDB = null;

            header("location: /Pages/Gestion/Salles/index.php?m=". ($success == true? 1 : 0));
        }

        
        exit();
    }
    
    header("location: /index.php");
?>