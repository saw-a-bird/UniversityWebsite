<html>
<head>
    <link rel="stylesheet" href="Assets/css/user.css">
    <link rel="stylesheet" href="Assets/css/admininter.css">
</head>
<body>
    <?php
        session_start();
        include("Pipes/get_login.php");
        include("config.php");
    ?>
    <div class="logo">  
        <div class = "header_div">
            <img src="Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <h3 class = "deconnection absolute"> <a href="Pipes/deconnexion.php">Se deconnecter</a></h3>
    </div>

    <div class="content">
        <h1>Salutation Admin<br> <span><?= $user["nom"]." ".$user["prenom"] ?> </span>  </h1>
  
        <div class = "user_ability_list">
            <div>
                <img src="Assets/imgs/account_icon.png"> 
                <a href = "profile.php"> <h4> Consulter votre compte </h4> </a>
            </div>
            <div>
                <img src="Assets/imgs/adm_inscription.png" />
                <a href = "adm_inscription.php"> <h4> Configurer l'inscription </h4> </a>
            </div>
            
            <div>
                <img src="Assets/imgs/users_icon.png" />
                <a href = "adm_users.php"> <h4> Gestion les utilisateurs </h4> </a>
            </div>
        </div>
    </div>

    <div class="image" style = "display:flex; align-items: flex-end;">
        <img src="Assets/imgs/prof.png" alt="prof_pic" class="prof_pic" />
        <img src="Assets/imgs/PC.png" style = "height: fit-content;margin-left: auto;"  alt="PC" class="PC"  />
    </div>

    </body>
    </html>
    
