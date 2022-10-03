<?php
    session_start();
    
    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == 0) {
        if (isset($_GET["cin"])) {
            require_once("../Classes/UtilisateurDB.php");
            $utilisateurDB = new UtilisateurDB();
            $utilisateurDB->delete($_GET["cin"]);
            $utilisateurDB = null;
        }
    }

    header("location: ../adm_users.php");
?>