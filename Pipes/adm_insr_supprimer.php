<?php
    session_start();
    $securityRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $securityRole) {
        if (isset($_GET["cin"])) {
            require_once("../Classes/InscriptionDB.php");
            $inscriptionDB = new InscriptionDB();
            $inscriptionDB->delete($_GET["cin"]);
            $utilisateurDB = null;
        }

        header("location: /User/SuperAdmin/Gestion/Inscriptions/index.php");
        exit();
    }
    
    header("location: /index.php");
?>