<?php

session_start();
if (isset($_SESSION["login"])) {
    $_SESSION["login"] = null;
}

if (isset($_GET["email"]) && isset($_GET["activation_code"])) {
    $email = $_GET["email"];

    require_once("../Classes/Database/UtilisateurDB.php");
    $utilisateurDB = new UtilisateurDB();
    $response = $utilisateurDB->verify_activation_code($_GET["activation_code"], $email);

    if (is_array($response)) {
        // SEND password to email
        require_once("../Classes/Emailer.php");
        $emailer = new Emailer($email);
        $new_password = $emailer->create_new_password();

        if ($emailer->send()) {
            $utilisateurDB->activate_user($response["matricule"], $new_password);

            // success: password sent
            header("location: /login.php?m=2");
        } else {
            // error: email service offline
            header("location: /login.php?m=-2");
        }
    } else {
        // errors: already expired, already active, not found
        header("location: /login.php?m=".$response);
    }
} else {
    // error: WEIRD LINK
    header("location: /login.php?m=-5");
}