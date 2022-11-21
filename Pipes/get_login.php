<?php
    // MAIN OBJECTIVE: check authentification, get user object OTHERWISE log-out.

    // Check logged-in
    if (isset($_SESSION["login"])) {
        function deconnexion() {
            header("location: /Pipes/deconnexion.php");
        }

        $sessionRole = $_SESSION["login"]["role"];

        // Check authentification (site demands 2 <  you have 3, redirect)
        if ((isset($securityRoleAbs) && $securityRoleAbs != $sessionRole) || (isset($securityRole) && $securityRole < $sessionRole)) {
            header("location: /Pages/User/index.php");
        }

        // Get user object
        $matricule = $_SESSION["login"]["matricule"];
        require_once(ROOT."/Classes/Database/UtilisateurDB.php");
        $utilisateurDB = new UtilisateurDB();
        $user = $utilisateurDB->getUserByMatricule($matricule);

        if (!empty($user)) {
            require(ROOT."/Classes/Roles.php");
            $authName = Roles::getName($user["role"]);
            // if role user, get department and merge.
            // if ($sessionRole == Roles::ByName("Etudiant")) {
            //     require_once(ROOT."/Classes/Database/EtudiantGroupDB.php");
            //     $etudiantGrpDB = new EtudiantGroupDB();
            //     $etdGrp = $etudiantGrpDB->get($matricule);

            //     if ($etdGrp != 1) {
            //         $user = array_merge($user, $etdGrp);
            //     } else {
            //         deconnexion();
            //         exit();
            //     }
            // }
        } else {
            deconnexion();
        }
    } else {
        header("location: /index.php");
    }
?>