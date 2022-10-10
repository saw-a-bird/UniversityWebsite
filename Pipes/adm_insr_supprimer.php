<?php
    session_start();
    $authRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $authRole) {
        if (isset($_GET["cin"])) {
            require_once("../Classes/InscriptionDB.php");
            $inscriptionDB = new InscriptionDB();
            $inscriptionDB->delete($_GET["cin"]);
            $utilisateurDB = null;
        }
    }

    header("location: /User/Directeur/Gestion/Inscriptions/index.php");
?>