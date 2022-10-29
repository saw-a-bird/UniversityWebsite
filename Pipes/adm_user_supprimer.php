<?php
    session_start();
    $securityRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $securityRole) {
        if (isset($_GET["matricule"])) {
            require_once("../Classes/UtilisateurDB.php");
            $utilisateurDB = new UtilisateurDB();
            $utilisateurDB->delete($_GET["matricule"]);
            $utilisateurDB = null;
        }

        header("location: /User/SuperAdmin/Gestion/Users.php?m=1");
        exit();
    }

    header("location: /index.php");
?>