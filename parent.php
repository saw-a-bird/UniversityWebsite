<html>
<head>
    <link rel="stylesheet" href="Assets/css/user.css">
</head>
<body>
    <?php
        session_start();
        include("Pipes/get_login.php");
    ?>
    <div class="logo">  
        <div class = "header_div">
            <img src="Assets/imgs/LOGO.png">
            <h2 class = "website_title"> NOM DE L’INSTITUTE </h2>
        </div>

        <h3 class = "deconnection"> <a href="Pipes/deconnexion.php">Se deconnecter</a></h3>
    </div>
        
    <div class="content">
        <h1>Salut Etudiant<br> <span><?= $user["nom"]." ".$user["prenom"] ?> </span>  </h1>
  
        <div>
            <img src="Assets/imgs/account_icon.png"> 
            <a href = "profile.php"> <h4> Consulter votre compte </h4> </a>
        </div>
    </div>


    <div class="image">
        <img src="Assets/imgs/family.png">
    </div>

</body>

