<html>
<head>
    <?php
        session_start();
        $securityRole = 0;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title> Bonsoir - <?= $authName ?> </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/pagination.css">
</head>
<body>
    <div class="logo">  
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <h3 class = "deconnection absolute"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
    </div>

    <div class="content">
        <h1 class = "_block">Bonsoir <?= $authName ?> </h1>
        <h2 style = "margin-top: 0">Nom & Prenom: <?= $user["nom"]." ".$user["prenom"] ?></h2>

        <div class = "user_ability_list">
            <div class="carousel-slider" id="responsive">
                <div class="carousel-content" data-pagination="true">
                    <aside class="slide-item">
                        <div>
                            <img src="/Assets/imgs/account_icon.png"> 
                            <a href = "/User/Account/profile.php"> <h4> Consulter votre compte </h4> </a>
                        </div>
                        <div>
                            <img src="/Assets/imgs/adm_inscription.png" />
                            <a href = "Gestion/Inscriptions/index.php"> <h4> Configurer l'inscription </h4> </a>
                        </div>
                        
                        <div>
                            <img src="/Assets/imgs/adm_inscription.png" />
                            <a href = "Gestion/Sessions/index.php"> <h4> Liste des sessions </h4> </a>
                        </div>

                    </aside>
                    <aside class="slide-item">
                        <div>
                            <img src="/Assets/imgs/users_icon.png" />
                            <a href = "Gestion/Users.php"> <h4> Gestion les utilisateurs </h4> </a>
                        </div>
                    </aside>
                </div>
                <button class="carousel-prev-btn">&larr;</button>
                <button class="carousel-next-btn">&rarr;</button>
                <div class="carousel-pagination"></div>
            </div>
            
        </div>
    </div>

    <div class="image" style = "display:flex; align-items: flex-end;">
        <img src="/Assets/imgs/director.png" alt="prof_pic" class="prof_pic" />
        <img src="/Assets/imgs/PC.png" style = "height: fit-content;margin-left: auto;"  alt="PC" class="PC"  />
    </div>

    <script src="/Assets/js/pagination.js"></script>
    <link rel="stylesheet" href="/Assets/css/pagination.css">
    </body>
</html>
    
