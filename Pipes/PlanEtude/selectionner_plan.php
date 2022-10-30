<?php
    session_start();
    $securityRole = 2;

    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] <= $securityRole && isset($_GET["parcours_id"]) && isset($_GET["plan_id"])) {
        require_once("../../Classes/PlanEtudeDB.php");
        $planEtudeDB = new PlanEtudeDB();
        $planEtudeDB->select($_GET["parcours_id"], $_GET["plan_id"]);

        header("location: /User/Admin/Gestion/PlanEtude/index.php");
        exit();
    }

    header("location: /index.php");
?>