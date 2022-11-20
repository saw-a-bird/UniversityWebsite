<?php
    session_start();
    $securityRole = 0;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == $securityRole && isset($_GET["numero"])) {
        require_once("../../Classes/Database/GlobalDB.php");
        $globalDB = new GlobalDB();
        $globalDB->setSession($_GET["numero"]);
        header("location: /User/SuperAdmin/Gestion/Sessions/index.php");
        exit();
    }

    header("location: /index.php");
?>