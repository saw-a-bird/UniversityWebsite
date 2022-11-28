<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {

        if (isset($_GET["id"])) {
            require_once("../../Classes/Database/ClasseDB.php");
            $classeDB = new ClasseDB();
            $success = $classeDB->delete($_GET["id"]);
            $classeDB = null;

            header("location: /Pages/Gestion/Classes/index.php");
        }

        
        exit();
    }
    
    header("location: /index.php");
?>