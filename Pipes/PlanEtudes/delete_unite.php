<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {
        if (isset($_GET["id"]) && isset($_GET["plan"])) {
            require_once("../../Classes/Database/UniteDB.php");
            $uniteDB = new UniteDB();
            $success = $uniteDB->delete($_GET["id"]);
            $uniteDB = null;

            header("location: /User/Admin/Gestion/PlanEtude/afficher.php?id=".$_GET["plan"]);
        }

        
        exit();
    }
    
    header("location: /index.php");
?>