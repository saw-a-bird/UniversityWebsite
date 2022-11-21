<?php
    session_start();

    if (isset($_SESSION["login"])) {
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        require(ROOT."/Classes/Roles.php");
        header("location: /Pages/User/".Roles::getName($_SESSION["login"]["role"])."/index.php");
    } else {
        header("location: /index.php");
    }
?>