
<!DOCTYPE html>
<html>
    <head>
      <?php
          session_start();
          if (isset($_SESSION["login"])) {
              header("location: /Pages/User/index.php");
          }
          require_once("config.php");
      ?>
      <link rel="stylesheet" href="/Assets/css/login.css">
      <title>Login</title>
    </head>
<body>
  <?php
    if (isset($_GET["m"])) {
      switch ($_GET["m"]) {
        case 1:
          $message = "<p class = 'green_alert'>Compte est créé avec succes. Nous avons envoyé un e-mail avec un lien de confirmation à votre adresse e-mail.</p>";
          break;
      case 2: 
          $message = "<p class = 'green_alert'>Succes. La lien de confirmation est valide. Nous avons envoyé un e-mail avec ton mot de passe à votre adresse e-mail.</p>";
          break;
        case -1:
          $message = "<p class = 'red_alert'>Cette compte n'existe pas dans la base de donnée.</p>";
          break;
        case -2: 
          $message = "<p class = 'red_alert'>Error. La lien de confirmation est valide, mais notre service d'email n'est pas disponible dans le moment. Veuillez réessayer plus tard. </p>";
          break;
        case -3: 
          $message = "<p class = 'red_alert'>Cette lien d'activation est déja expiré. Veuillez à créé un nouveau compte.</p>";
          break;
        case -4:
            $message = "<p class = 'red_alert'>Cette compte est déja active. Vérifiez votre e-mail pour le mot de passe.</p>";
          break;
        case -5:
          $message = "<p class = 'red_alert'>La lien d'activation est bizarre. Veuillez réessayer plus tard.</p>";
          break;
      }
    }

    if (isset($_POST["loginbtn"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];

      if (isset($email) && isset($password)) {
        // check if email exists.
        require_once("Classes/Database/UtilisateurDB.php");
        $utilisateurDB = new UtilisateurDB();
        $user = $utilisateurDB->emailExists($email, 1);
        if (!empty($user)) {
          if ($_POST["password"] === $user["password"]) {
            if ($user["isActive"] == 1) {

              $_SESSION["login"] = array("matricule" => $user["matricule"], "role" => $user["role"]);
              header("location: /Pages/User/index.php");

            } else {
              $message = "<p class = 'red_alert'>Error. Cette compte n'est pas encore active.</p>";
            }
          } else {
            $message = "<p class = 'red_alert'>Error. Veuiller à verifier notre credentials.</p>";
          }
        } else {
          $message = "<p class = 'red_alert'>Error. Cette e-mail n'existe pas dans la base de données.</p>";
        }
      } else {
        $message = "<p class = 'red_alert'>Error. La formulaire est erroné.</p>";
      }
    }
  ?>

    <div class="imgcontainer">
      <header id="header"><?= NOM_SITE ?></header>
      <img src="/Assets/imgs/logo.png" alt="logo" class="logo">
    </div>

    <form class="formulaire" method = "post">  
        <div style = "margin-bottom: 30px;">
            <span class="log"> Log-In</span>
        </div>
        <div class="container">
          <?php if (isset($message)) { echo "$message"; } ?>
          
          <label for="email"></label>
          <input type="text" placeholder="Email" name="email" required><br>
      
          <label for="password"></label>
          <input type="password" placeholder="Password" name="password" required><br>
          <button type="submit" name = "loginbtn" class = "login_btn">Login</button> 
          
        </div>
        </form>
        <div style = "margin-bottom:auto;">
          <p class="psw">
              Vous n'avez pas un compte? appuier ici pour <a href="/index.php">s'inscrire.</a>
              <br>vous avez oublié votre password? appuier <a href="/forgot_password.php">ICI </a>
          </p>
      </div>

        <div class = "login_imgs">
          <img src="/Assets/imgs/p_login_left.png" alt="logleft" class="logleft">
          <img src="/Assets/imgs/p_login_right.png" alt="logright" class="logright">
        </div>



</body>
</html>