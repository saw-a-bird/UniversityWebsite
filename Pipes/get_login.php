<?php
    // MAIN OBJECTIVE: check authentification, get user object OTHERWISE log-out.

    // Check logged-in
    if (isset($_SESSION["login"])) {
        function deconnexion() {
            header("location: /Pipes/deconnexion.php");
        }

        $sessionRole = $_SESSION["login"]["role"];

        // Check authentification
        if (isset($securityRole) && $sessionRole != $securityRole) {
            header("location: /User/index.php");
        } elseif (isset($leastRole) && $sessionRole > $leastRole) {
            header("location: /User/index.php");
        }

        // Get user object
        $matricule = $_SESSION["login"]["matricule"];
        require_once(ROOT."/Classes/UtilisateurDB.php");
        $utilisateurDB = new UtilisateurDB();
        $user = $utilisateurDB->getUserByMatricule($matricule);

        if (!empty($user)) {
            require(ROOT."/Classes/Roles.php");
            $authName = Roles::getName($user["role"]);
            // if role user, get department and merge.
            if ($sessionRole == 3) {
                require_once(ROOT."/Classes/EtudiantGroupDB.php");
                $etudiantGrpDB = new EtudiantGroupDB();
                $etdGrp = $etudiantGrpDB->get($matricule);

                if ($etdGrp != 1) {
                    $user = array_merge($user, $etdGrp);
                } else {
                    deconnexion();
                    exit();
                }
            }
        } else {
            deconnexion();
        }
    } else {
        header("location: /index.php");
    }
?>