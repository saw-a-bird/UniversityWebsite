<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {
        if (isset($_GET["id"])) {
            require_once("../../Classes/Database/PlanEtudeDB.php");
            $planEtudeDB = new PlanEtudeDB();
            $success = $planEtudeDB->delete($_GET["id"]);
            $planEtudeDB = null;

            header("location: /User/Admin/Gestion/PlanEtude/index.php?m=". ($success == true? 1 : 0));
        }

        
        exit();
    }
    
    header("location: /index.php");
?>