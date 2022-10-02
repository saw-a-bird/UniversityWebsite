<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="Assets/css/iscri_form.css">
    <link rel="stylesheet" href="Assets/css/general.css">
</head>
<body>
    <?php
        session_start();
        include("config.php");

        if (isset($_SESSION["login"])) {
            header("location: Pipes/login_redirect.php");
        }

        // check if CIN exists (in LIST if role is not admin or parent)
        // remove CIN from SESSION after validation (security)
        require_once("Classes/UtilisateurDB.php");
        $utilisateurDB = new UtilisateurDB();
        // first of all, for security purposes and to get role.

        if ($utilisateurDB->getIState() == 0) {
            header("Location: closed.html");
        }
        
        $cin = $_SESSION["INSCRIPTION_CIN"];
        if ($utilisateurDB->userExists($cin) == true) {
            header("Location: index.php");
        }

        $role = $utilisateurDB->listeExists($cin);
        if ($role == false) {
            $role = 2;
            $roleError = "Ton CIN n'existe pas dans la liste! Est-ce que vous un parent?";
        }

        if (isset($_POST["confirmbtn"])) {
            $post_nom = $_POST["nom"];
            $post_prenom = $_POST["prenom"];
            $post_adresse = $_POST["adresse"];
            $post_sexe = $_POST["sexe"];
            $post_email = $_POST["email"];
            $post_dep = $_POST["department"];

            // check general errors
            if ((!empty($post_nom) && !empty($post_prenom) && !empty($post_adresse) && !empty($post_email)) && ($post_sexe >= 1 && $post_sexe <= 2) &&($post_dep >= 1 && $post_dep <= 4)) {

                // check specific errors
                if ($utilisateurDB->emailExists($post_email)) {
                    $emailError = "Email déja utilisé auparavant!";
                } elseif(!filter_var($post_email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Cette format d'email n'est pas valide.";
                }

                // if parent: check if selected the right role 
                // if student/enseignant: check if selected his role.
                if ($role == 2) {
                    $post_etd_cin = $_POST["etd_cin"];
                    if (!$utilisateurDB->userExists($post_email)) {
                        $etdError = "Cette etudiant CIN n'existe pas dans la base de donnée.";
                    }
                }

                if (!isset($emailError, $etdError)) {
                    // create classes
                    require_once("Classes/Etudiant.php");
                    require_once("Classes/Utilisateur.php");

                    $role;
                    if ($role == 3) {
                        $user = new Etudiant();
                    } else {
                        $user = new Utilisateur();
                    }

                    // info
                    $user->setCIN($cin)
                        ->setNom($_POST["nom"])
                        ->setPrenom($_POST["prenom"])
                        ->setAdresse($_POST["adresse"])
                        ->setEmail($post_email)
                        ->setSexe($post_sexe)
                        ->setDateNaissance($_POST["date_dn"]);

                    $user->setRole($role);

                    //email activation 
                    require_once("Classes/Emailer.php");
                    $emailer = new Emailer($post_email);
                    $user->setActivationCode($emailer->send_activation_email());
                    
                    // insert objects
                    $utilisateurDB->insert($user);
                    $utilisateurDB = null;

                    if ($role == 3) {
                        $user->setDepartmentID($post_dep);
                        require_once("Classes/EtudiantDB.php");
                        $etudiantDB = new EtudiantDB();
                        $etudiantDB->insert($user);
                        $etudiantDB = null;
                    }

                    //SUCCESS CREATION
                    header("Location: login.php?m=0");
                }
            } else {
                $generalErrors = "La formulaire est erroné, verifier tes informations.";
            }
        }

    ?>
         <!--logo and name--> 
    <div>
        <img src="Assets/imgs/LOGO.png" alt="LOGO" id="logo">
        <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>
    <!--form-->
    <div id="container">
        <form action="" method="post" id="f">
            <?php if (isset($generalErrors)) echo "<span class = '_error'> $generalErrors </span>"; ?>
            <label for="role" class="lab_form"> Role :</label>
            <?php if (isset($roleError)) echo "<span class = '_error' style = 'color: #ac5151;'> $roleError </span>"; ?>
            <select id="role_form" class="drop_form" name="role" disabled>
                <option value="1">Enseignant</option>
                <option value="2">Parent</option>
                <option value="3">Etudiant</option>
            </select>

            <label for="prenom" class="lab_form"> Prenom :</label>
            <input type="text" class="lab_in_txt" name = "prenom" required>
            
            <label for="nom" class="lab_form"> Nom :</label>
            <input type="text" class="lab_in_txt" name = "nom" required>
            
            <label for="sexe" class="lab_form"> Sexe :</label>
            <select id="sexe" class="drop_form" name="sexe">
                <option value="1">Homme</option>
                <option value="2">Femme</option>
            </select>

            <label for="date_dn" class="lab_form"> Date de naissance :</label>
            <input type="date" name="date_dn" id="lab_in_date" required>

            <label for="adresse" class="lab_form"> Adresse :</label>
            <input type="text" class="lab_in_txt"  name = "adresse" required>

            <label for="email" class="lab_form"> Email :</label> <?php if (isset($emailError)) echo "<span class = '_error'> $emailError </span>"; ?>
            <input type="email" class="lab_in_txt" name = "email" required>

            <div id = "dep_div"> <!-- LACKS SECURITY!!!! SAME AS SEXE  -->
                <label for="department" class="lab_form"> Department :</label>
                <select id="department" class="drop_form" name="department">
                    <option value="1">Informatique</option>
                    <option value="2">Mecanique</option>
                    <option value="3">Electrique</option>
                    <option value="4">Gestion</option>
                </select>
            </div>

            <div id = "etd_cin_div">
                <label for="etd_cin" class="lab_form"> Etudiant CIN :</label> <?php if (isset($etdError)) echo "<span class = '_error'> $etdError </span>"; ?>
                <input type="text" class="lab_in_txt" name = "etd_cin">
            </div>
            <script>
                var role = <?= $role ?>;
                const selectBox = document.querySelector('#role_form');
                selectBox.options[role-1].selected = true;

                var dep_div = document.getElementById("dep_div");
                var etd_cin_div = document.getElementById("etd_cin_div");
                // function roleChange() {
                //     divShow();
                // }
                
                function divShow() {
                    switch(parseInt(selectBox.value)) {
                        case 3:
                            dep_div.classList.remove("hide");
                            etd_cin_div.classList.add("hide");
                            break;
                        case 2:
                            dep_div.classList.add("hide");
                            etd_cin_div.classList.remove("hide");
                            break;
                        default:
                            dep_div.classList.add("hide");
                            etd_cin_div.classList.add("hide"); 
                            break; 
                    }
                }
                divShow();
                
            </script>

            <label for="terms" class = "terms_conditions">  
                <input type="checkbox" id="terms" name="terms" value="terms" onclick="checkTerms(this)" required> <span id="term_t">Accepter termes de confidentalités </span>
            </label>

           <input type="submit" value="Confirmer" id="Confirmer" name = "confirmbtn" disabled>
           <a class = "go_back_btn" href = "index.php"> <p > Retourner </p> </a>

           <script>
            var termsCheckbox = document.getElementById("terms");
                var confirmBtn = document.getElementById("Confirmer");

               function checkTerms() {
                    confirmBtn.disabled = !termsCheckbox.checked;
                }
            </script>
        </form>
    </div>
    <div style = "margin-top:20px"  > </div>
    <!--the img-->
    <img src="Assets/imgs/person_form.png" alt="person" id="form_img">

</body>
</html>