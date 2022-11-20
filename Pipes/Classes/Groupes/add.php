<?php
    session_start();
    $securityRole = 1;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {

        if (isset($_GET["numero"]) && isset($_GET["classeId"])) {
            require_once("../../../Classes/Database/GroupeDB.php");
            $groupDB = new GroupeDB();
            $success = $groupDB->insert($_GET["classeId"], $_GET["numero"]);
            $groupDB = null;

            header("location: /User/Directeur/Gestion/Classes/Groupes/index.php?classeId=".$_GET["classeId"] . "&m=". ($success == true? 1 : 0));
        }

        
        exit();
    }
    
    header("location: /index.php");
?>