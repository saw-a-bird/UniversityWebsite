<?php
    session_start();
    $securityRole = 0;
    
    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $securityRole) {
        if (isset($_GET["state"]) && is_numeric($_GET["state"])) {
            $state = $_GET["state"]%2;
            if ($state >= 0 && $state <= 1) {
                require_once("../Classes/InscriptionDB.php");
                $inscriptionDB = new InscriptionDB();
                $inscriptionDB->changeIState($state);
            }
        }

        header("location: /User/SuperAdmin/Gestion/Inscriptions/index.php");
        exit();
    }
    
    header("location: /index.php");
?>