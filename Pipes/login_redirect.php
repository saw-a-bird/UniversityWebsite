<?php
session_start();

switch ($_SESSION["login"]["role"]) {
    case 3:
        header("location: ../etudiant.php");
        break;
    case 1:
        header("location: ../enseignant.php");
        break;
    case 2:
        header("location: ../parent.php");
        break;
    case 0:
        header("location: ../admin.php");
        break;
}