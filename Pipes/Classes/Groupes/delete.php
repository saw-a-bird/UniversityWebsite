<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {

        if (isset($_GET["groupeId"]) && isset($_GET["classeId"])) {
            require_once("../../../Classes/Database/GroupeDB.php");
            $groupDB = new GroupeDB();
            $success = $groupDB->delete($_GET["groupeId"]);
            $groupDB = null;

            header("location: /Pages/Gestion/Classes/Groupes/index.php?classeId=".$_GET["classeId"] . "&m=". ($success == true? 1 : 0));
        }

        
        exit();
    }
    
    header("location: /index.php");
?>