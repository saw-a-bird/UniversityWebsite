<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        if (isset($_SESSION["login"])) {
            header("location: /User/index.php");
        }

        require_once("config.php");
    ?>

    <title>Formulaire - Inscription</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Assets/css/main_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
</head>
<body>
    <?php
        // check if CIN exists (in LIST if role is not admin or parent)
        // remove CIN from SESSION after validation (security)

        // first of all, for security purposes and to get role.

        require_once("Classes/Database/GlobalDB.php");
        $globalDB = new GlobalDB();
  
        if ($globalDB->getInscription() == 0) {
            header("Location: closed.php");
        } elseif (!isset($_SESSION["INSCRIPTION_CIN"])) {
            header("Location: index.php");
        } else {

            require_once("Classes/Roles.php");
            $cin = $_SESSION["INSCRIPTION_CIN"];
            
            require_once("Classes/Database/UtilisateurDB.php");
            $utilisateurDB = new UtilisateurDB();
            if ($utilisateurDB->exists($cin) == true) {
                $generalErrors = "Cette CIN est déja utilisé auparavant!";
            }

            require_once("Classes/Database/InscriptionDB.php");
            $inscriptionDB = new InscriptionDB();

            $inscription = $inscriptionDB->getInfo($cin);
            $role = $inscription["role"];
            $department = $inscription["departmentID"];

            if ($role == false) {
                $role = 2;
                $roleInfo = "Ton CIN n'existe pas dans la liste! Est-ce que vous un parent?";
            }
    
            if (isset($_POST["confirmbtn"])) {
                // if ($role != $_POST["role"]) {
                //     $roleError = "La rôle n'est pas le même que celui dans la base de donnée!";
                // }

                $post_nom = $_POST["nom"];
                $post_prenom = $_POST["prenom"];
                $post_adresse = $_POST["adresse"];
                $post_sexe = $_POST["sexe"];
                $post_email = $_POST["email"];
                $post_date = $_POST["date_dn"];

                // check general errors
                if ((!empty($post_nom) && !empty($post_prenom) && !empty($post_adresse) && !empty($post_email)) && ($post_sexe >= 1 && $post_sexe <= 2)) {
    
                    // check specific errors
                    if(!filter_var($post_email, FILTER_VALIDATE_EMAIL)) {
                        $emailError = "Cette format d'email n'est pas valide.";
                    } elseif ($utilisateurDB->emailExists($post_email) == true) {
                        $emailError = "Email déja utilisé auparavant!";
                    }
    
                    if (!isset($roleError) && !isset($generalErrors) && !isset($emailError) && !isset($etdError)) {
    
                        //email activation 

                        $result = true;
                        if (DEBUG == false) { // if debug, don't send email + confirm user
                            require_once("Classes/Emailer.php");
                            $emailer = new Emailer($post_email);
                            $codeActivation = $emailer->create_activation_email();
                            $result = $emailer->send();
                        }

                        if ($result == true) {
                            require_once("Classes/Utilisateur.php");
                            $user = new Utilisateur();
        
                            // info
                            $user->setCIN($cin)
                                ->setNom($_POST["nom"])
                                ->setPrenom($_POST["prenom"])
                                ->setAdresse($_POST["adresse"])
                                ->setEmail($post_email)
                                ->setSexe($post_sexe)
                                ->setDepartmentID($department)
                                ->setDateNaissance($post_date)
                                ->setActivationCode(DEBUG ? "00000": $codeActivation)
                                ->setIsConfirmed(DEBUG ? 1 : 0)
                                ->setRole($role);

                            // insert objects
                            $utilisateurDB->insert($user);

                            // SUCCESS CREATION
                            $_SESSION["INSCRIPTION_CIN"] = null; // remove

                            if (DEBUG) {
                                header("Location: login.php?m=3");
                            } else {
                                header("Location: login.php?m=1");
                            }
                        } else {
                            $generalErrors = "Error. La service Emailer n'est pas disponible maintenant. Veuillez réessayer plus tard.";
                        }
                    }
                } else {
                    $generalErrors = "La formulaire est erroné, verifier tes informations.";
                }
            }
        }

    ?>
         <!--logo and name--> 
    <div>
        <img src="/Assets/imgs/LOGO.png" alt="LOGO" id="logo">
        <h1 id="nom_uni"> <?= NOM_SITE ?> </h1>
    </div>
    <!--form-->
    <div id="container">
        <form action="" method="post" id="f">
            <?php if (isset($generalErrors)) echo "<span class = '_error'> $generalErrors </span>"; ?>
            <label for="role" class="_form"> Role :</label>
            <?php if (isset($roleInfo)) echo "<span class = '_error' style = 'color: #ac5151;'> $roleInfo </span>"; ?>
            <?php if (isset($roleError)) echo "<span class = '_error' style = 'display:block'> $roleError </span>"; ?>

            <select id="role_form" class="drop_form" name="roleC" disabled>
                <?php
                    foreach (Roles::getAll() as $id => $name) {
                        echo "<option value='$id'>$name</option>";
                    }
                ?>
            </select>

            <label for="prenom" class="_form"> Prenom :</label>
            <input type="text" class="lab_in_txt" name = "prenom" value = "<?= isset($post_nom)? $post_nom: '' ?>" required>
            
            <label for="nom" class="_form"> Nom :</label>
            <input type="text" class="lab_in_txt" name = "nom" value = "<?= isset($post_prenom)? $post_prenom: '' ?>" required>
            
            <label for="sexe" class="_form"> Sexe :</label>
            <select id="sexe"  class="drop_form" name="sexe" id="sexe_form">
                <option value="1">Homme</option>
                <option value="2">Femme</option>
            </select>

            <label for="date_dn" class="_form"> Date de naissance :</label>
            <input type="date" name="date_dn" id="lab_in_date" value = "<?= isset($post_date)? $post_date: '' ?>" required>

            <label for="adresse" class="_form"> Adresse :</label>
            <input type="text" class="lab_in_txt"  name = "adresse" value = "<?= isset($post_adresse)? $post_adresse: '' ?>" required>

            <div>
                <label for="email" class="_form lab_form"> Email :</label> <?php if (isset($emailError)) echo "<span class = '_error _email_error'> $emailError </span>"; ?>
                <input type="email" class="lab_in_txt" name = "email" value = "<?= isset($post_email)? $post_email: '' ?>" required>
            </div>
            <div id = "dep_div">
                <label for="department" class="_form"> Department :</label>
                <select class="drop_form" name="department" id = "dep_form" disabled>
                    <?php
                        require_once("Classes/Database/DepartmentDB.php");
                        $departmentDB = new DepartmentDB();
                        foreach ($departmentDB->getAll() as $row) {
                            echo "<option value='".$row["id"]."'>".$row["nom"]."</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- <div id = "etd_cin_div">
                <label for="etd_cin" class="lab_form"> Etudiant CIN :</label> <?php // if (isset($etdError)) echo "<span class = '_error'> $etdError </span>"; ?>
                <input type="text" class="lab_in_txt" name = "etd_cin">
            </div> -->
            <script>
                var role = <?= $role ?>;
                const selectBoxRole = document.getElementById('role_form');
                selectBoxRole.options[role-1].selected = true;

                var dep = <?= $department ?>;
                const selectBoxDep = document.getElementById('dep_form');
                selectBoxDep.options[dep-1].selected = true;

                <?php 
                    if (isset($post_sexe)) {
                        echo "var sexe = ".$post_sexe.";
                        const selectBox = document.getElementById('sexe_form');
                        selectBox.options[sexe-1].selected = true;";
                    }
                ?>

                // var dep_div = document.getElementById("dep_div");
                // var etd_cin_div = document.getElementById("etd_cin_div");
                // // function roleChange() {
                // //     divShow();
                // // }
                
                // function divShow() {
                //     switch(parseInt(selectBox.value)) {
                //         case 3:
                //             dep_div.classList.remove("hide");
                //             etd_cin_div.classList.add("hide");
                //             break;
                //         case 2:
                //             dep_div.classList.add("hide");
                //             etd_cin_div.classList.remove("hide");
                //             break;
                //         default:
                //             dep_div.classList.add("hide");
                //             etd_cin_div.classList.add("hide"); 
                //             break; 
                //     }
                // }
                // divShow();
                
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
    <img src="/Assets/imgs/person_form.png" alt="person" id="form_img">

</body>
</html>