<!--colors : 
#2AD2F4
#B1740F
#FDB833

fonts :
Futura 
Proxima Nova -->

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="Assets/css/login.css">
      </head>
<body>
    <section>
        <div class="imgcontainer">
            <header id="header">NOM DE L'INSTITUT</header>
            <img src="Assets/imgs/logo.png" alt="logo" class="logo">
           
          </div>

    </section>
    <section>

    <?php

      session_start();
      if (isset($_SESSION["login"])) {
        header("location: Pipes/login_redirect.php");
      }

      if (isset($_GET["m"])) {
        switch ($_GET["m"]) {
          case 0:
            $message = "<p class = 'green_alert'>Compte est créé avec succes. Nous avons envoyé un e-mail avec un lien de confirmation à votre adresse e-mail.</p>";
            break;
          case 1:
              $message = "<p class = 'red_alert'>Cette email n'existe pas dans la base de donnée.</p>";
              break;
          case 2: 
              $message = "<p class = 'red_alert'>Cette lien de confirmation est déja expiré. Veuillez à créé un nouveau compte.</p>";
              break;
            case 3: 
              $message = "<p class = 'green_alert'>Succes. La lien de confirmation est valide. Nous avons envoyé un e-mail avec ton mot de passe à votre adresse e-mail.</p>";
              break;
        }
      }

    if (isset($_POST["loginbtn"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];
      if (isset($email, $password)) {
        // check if email exists.
        require_once("Classes/UtilisateurDB.php");
        $utilisateurDB = new UtilisateurDB();
        $user = $utilisateurDB->emailExists($email, 1);
        if ($user != -1) {
          if ($_POST["password"] === $user["password"]) {
            if ($user["isActive"] == 1) {
              $_SESSION['login'] = array("matricule" => $user["matricule"], "role" => $user["role"]);
              
                header("location: Pipes/login_redirect.php");

            } else {
              $message = "<p class = 'red_alert'>Error. Cette compte n'est pas encore active.</p>";
            }
          } else {
            $message = "<p class = 'red_alert'>Error. Veuiller à verifier notre credentials.</p>";
          }
        } else {
          $message = "<p class = 'red_alert'>Error. Cette e-mail n'existe pas dans la base de données.</p>";
        }
            // check is active  (Error. Cette compte n'est pas encore active.)

        } else {
          $message = "<p class = 'red_alert'>Error. La formulaire est erroné.</p>";
        }
      }

    ?>
    <form class="formulaire" method = "post">  
        <div>
            <span class="log"> Log-In</span>
        </div>
        <div class="container">
          <?php if (isset($message)) { echo "$message"; } ?>
          
          <label for="email"></label>
          <input type="text" placeholder="Email" name="email" required><br>
      
          <label for="password"></label>
          <input type="password" placeholder="Password" name="password" required><br>
          <button type="submit" name = "loginbtn">Login</button> 
          
        </div>
        </form>
        </section>
        <section>
            <footer>
          <p class="psw">vous n'avez pas un compte? appuier ici pour <a href="index.php">s'inscrire.</a>
            <br>vous avez oublié votre password? appuier <a href="forgot_password.php">ICI </a>
          </p>
          <img src="Assets/imgs/p_login_left.png" alt="logleft" class="logleft">
          <img src="Assets/imgs/p_login_right.png" alt="logright" class="logright">
    </footer>
    </section>


</body>
</html>