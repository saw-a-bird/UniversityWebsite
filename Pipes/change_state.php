<?php
    session_start();
    
    if (isset($_GET["state"]) && is_numeric($_GET["state"])) {
        $state = $_GET["state"]%2;
        if ($state >= 0 && $state <= 1) {
            require_once("../Classes/AdminDB.php");
            $adminDB = new AdminDB();
            $adminDB->changeIState($state);
        }
    }

    header("location: ../adm_inscription.php");

?>