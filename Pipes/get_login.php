<?php

    function deconnexion() {
        header("location: deconnexion.php");
    }
    // session must be open
    if (isset($_SESSION["login"])) {
        $matricule = $_SESSION["login"]["matricule"];
        require_once("Classes/UtilisateurDB.php");
        $utilisateurDB = new UtilisateurDB();
        $user = $utilisateurDB->getUserByMatricule($matricule);

        if ($user == -1) {
            deconnexion();
        } else {
            if ($_SESSION["login"]["role"] == 3) {
                require_once("Classes/EtudiantDB.php");
                $etudiantDB = new EtudiantDB();
                $etd = $etudiantDB->get($matricule);

                if ($etd != 1) {
                    $user = array_merge($user, $etd);
                } else {
                    deconnexion();
                }
            } else {
                // other roles
            }
        }
        


    } else {
        deconnexion();
    }

?>