<?php
    session_start();
    
    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == 0) {
        require_once("../Classes/InscriptionDB.php");
        $inscriptionDB = new InscriptionDB();
        $inscriptionDB->clear();
    }

    header("location: ../adm_inscri.php");
?>