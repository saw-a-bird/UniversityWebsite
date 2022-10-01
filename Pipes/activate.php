<?php

if (isset($_GET["email"]) && isset($_GET["activation_code"])) {
    $email = $_GET["email"];

    require_once("../Classes/UtilisateurDB.php");
    $utilisateurDB = new UtilisateurDB();
    $response = $utilisateurDB->verify_activation_code($_GET["activation_code"], $email);

    if ($response == -1) {
        // NOT FOUND
        header("location: ../login.php?m=1");
    } elseif ($response == 0) {
        // ALREADY EXPIRED
        header("location: ../login.php?m=2");
    } else {
        // SEND password to email
        require_once("../Classes/Emailer.php");
        $emailer = new Emailer($email);
        $new_password = $emailer->send_new_password();

        // ACTIVATE
        $utilisateurDB->activate_user($response["CIN"], $new_password);

        // REDIRECT to login 
        header("location: ../login.php?m=3");
    }

    $utilisateurDB = null;
}