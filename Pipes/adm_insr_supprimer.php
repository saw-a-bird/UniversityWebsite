<?php
    session_start();
    $securityRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $securityRole) {
        if (isset($_GET["id"])) {
            require_once("../Classes/Database/InscriptionDB.php");
            $inscriptionDB = new InscriptionDB();
            $inscriptionDB->delete($_GET["id"]);
            $utilisateurDB = null;
        }

        header("location: /User/SuperAdmin/Gestion/Inscriptions/index.php");
        exit();
    }
    
    header("location: /index.php");
?>