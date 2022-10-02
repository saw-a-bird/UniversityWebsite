<?php
    session_start();
    
    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == 0) {
        if (isset($_GET["cin"])) {
            require_once("../Classes/AdminDB.php");
            $adminDB = new AdminDB();
            $adminDB->removeFromList($_GET["cin"]);
        }
    }

    header("location: ../adm_inscription.php");
?>