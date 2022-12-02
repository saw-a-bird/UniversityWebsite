<?php
    session_start();
    $securityRole = 3;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole) {
        if (isset($_GET["id"])) {
            $messageId = $_GET["id"];
            require_once("../../../Classes/Database/BoiteDB.php");
            $boiteDB = new BoiteDB();
            if ($boiteDB->isCreator($messageId, $_SESSION["login"]["matricule"])) {
                $success = $boiteDB->delete($_GET["id"]);
                header("location: /Pages/Gestion/Boite/sent.php?m=". ($success == true? 1 : 0));
            }
            $boiteDB = null;
        }
        
        exit();
    }
    
    header("location: /index.php");
?>