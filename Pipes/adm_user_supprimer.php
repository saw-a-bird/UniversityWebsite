<?php
    session_start();
    $authRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $authRole) {
        if (isset($_GET["matricule"])) {
            require_once("../Classes/UtilisateurDB.php");
            $utilisateurDB = new UtilisateurDB();
            $utilisateurDB->delete($_GET["matricule"]);
            $utilisateurDB = null;
            header("location: /User/Directeur/Gestion/Users.php?m=1");
        }
    }
?>