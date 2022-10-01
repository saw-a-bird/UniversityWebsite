<?php
session_start();

if ($_SESSION["login"]["role"] == 1) { // enseignant
    header("location: ../enseignant.php");
} elseif ($_SESSION["login"]["role"] == 2) { // parent
    header("location: ../parent.php");
} elseif ($_SESSION["login"]["role"] == 3) { // parent
    header("location: ../utilisateur.php");
}