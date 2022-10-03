<?php
    session_start();
    
    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == 0) {
        if (isset($_GET["cin"])) {
            require_once("../Classes/InscriptionDB.php");
            $inscriptionDB = new InscriptionDB();
            $inscriptionDB->delete($_GET["cin"]);
        }
    }

    header("location: ../adm_inscri.php");
?>