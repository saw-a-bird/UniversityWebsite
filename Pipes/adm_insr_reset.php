<?php
    session_start();
    $securityRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $securityRole) {
        require_once("../Classes/Database/InscriptionDB.php");
        $inscriptionDB = new InscriptionDB();
        $inscriptionDB->clear();

        header("location: /User/SuperAdmin/Gestion/Inscriptions/index.php");
        exit();
    }

    header("location: /index.php");
?>