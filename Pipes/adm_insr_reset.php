<?php
    session_start();
    $authRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $authRole) {
        require_once("../Classes/InscriptionDB.php");
        $inscriptionDB = new InscriptionDB();
        $inscriptionDB->clear();
    }

    header("location: ../adm_inscri.php");
?>