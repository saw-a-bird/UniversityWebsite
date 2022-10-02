<?php
    session_start();
    
    if (isset($_SESSION["login"]) && $_SESSION["login"]["role"] == 0) {
        if (isset($_GET["cin"])) {
            // CASCADE: Remove Utilisateur, remove ALL related!
        }
    }

    header("location: ../adm_inscription.php");
?>