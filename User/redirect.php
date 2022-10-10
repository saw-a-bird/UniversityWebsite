<?php
    session_start();

    if (isset($_SESSION["login"])) {
        switch ($_SESSION["login"]["role"]) {
            case 3:
                header("location: /User/Etudiant/index.php");
                break;
            case 2:
                header("location: /User/Enseignant/index.php");
                break;
            case 1:
                header("location: /User/Admin/index.php");
                break;
            case 0:
                header("location: /User/Directeur/index.php");
                break;
        }
    } else {
        header("location: /index.php");
    }

?>