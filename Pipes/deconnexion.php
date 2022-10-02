<?php
    session_start();
    $_SESSION["login"] = null;
    header("location: ../login.php");
?>