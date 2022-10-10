<html>
<head>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <title> Page Principale - Enseignant </title>
</head>
<body>
    <?php
        session_start();
        $authRole = 2;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>
    <div class="logo">  
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <h3 class = "deconnection absolute"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
    </div>
        
    <div class="content">
        <h1>Salut Enseignant<br> <span><?= $user["nom"]." ".$user["prenom"] ?> </span>  </h1>
  
        <div>
            <img src="/Assets/imgs/account_icon.png"> 
            <a href = "/User/Account/profile.php"> <h4> Consulter votre compte </h4> </a>
        </div>
    </div>

    <div class="image" style = "display:flex; align-items: flex-end;">
        <img src="/Assets/imgs/prof_fm.png"  alt="PC" class="PC"  />
        <img src="/Assets/imgs/prof_m.png" alt="prof_pic" class="prof_pic" style = "height: fit-content;margin-left: auto;"/>
    </div>

</body>
