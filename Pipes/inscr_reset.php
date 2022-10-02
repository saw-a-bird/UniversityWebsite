<?php
    session_start();
    
    require_once("../Classes/AdminDB.php");
    $adminDB = new AdminDB();
    $adminDB->clearList();
    header("location: ../adm_inscription.php");

?>