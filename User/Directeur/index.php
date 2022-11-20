<html>
<head>
    <?php
        session_start();
        $securityRole = 1;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
    ?>

    <title> Page Principale - <?= $authName ?> </title>
    <link rel="stylesheet" href="/Assets/css/user.css">
</head>
<body>
    <?php
        include(ROOT."/Classes/Database/DepartmentDB.php");
        $departmentDB = new DepartmentDB();
    ?>

    <div class="logo">  
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <h3 class = "deconnection absolute"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
    </div>

    <div class="content">
        <h1 class = "_block">Salut <?= $authName ?> </h1>
        <h2 class = "_block" style = "margin-top: 0">Nom & Prenom: <?= $user["nom"]." ".$user["prenom"] ?></h2>
        <h3>Department: <?= $departmentDB->getNom($user["departmentID"]) ?><br>  </h3>
            
        <div class="carousel-slider" id="responsive">
            <div class="carousel-content" data-pagination="true">
                <aside class="slide-item">
                    <div>
                        <img src="/Assets/imgs/account_icon.png"> 
                        <a href = "/User/Account/profile.php"> <h4> Consulter votre compte </h4> </a>
                    </div>
                    
                    <div>
                        <img src="/Assets/imgs/adm_inscription.png" />
                        <a href = "../Admin/Gestion/PlanEtude/index.php"> <h4> Gestion de plans d'etude </h4> </a>
                    </div>
                    
                    <div>
                        <img src="/Assets/imgs/adm_inscription.png" />
                        <a href = "Gestion/Parcours/index.php"> <h4> Gestion de parcours </h4> </a>
                    </div>

                </aside>
                <aside class="slide-item">
                    <div>
                        <img src="/Assets/imgs/etds_crowd.png" />
                        <a href = "Gestion/Etudiants.php"> <h4> Gestion etudiants </h4> </a>
                    </div>

                    <div>
                        <img src="/Assets/imgs/ens_crowd.png" />
                        <a href = "Gestion/Enseignants.php"> <h4> Gestion enseignants </h4> </a>
                    </div>

                    <div>
                        <img src="/Assets/imgs/ens_crowd.png" />
                        <a href = "Gestion/Admins.php"> <h4> Gestion d'administrateurs </h4> </a>
                    </div>

                </aside>

                <aside class="slide-item">
                    <div>
                        <img src="/Assets/imgs/etds_crowd.png" />
                        <a href = "Gestion/Classes/index.php"> <h4> Gestion des classes </h4> </a>
                    </div>

                </aside>
            </div>
            <button class="carousel-prev-btn">&larr;</button>
            <button class="carousel-next-btn">&rarr;</button>
            <div class="carousel-pagination"></div>
        </div>
            
            <!-- <div>
                <img src="/Assets/imgs/users_icon.png" />
                <a href = "Gestion/Emplois.php"> <h4> Gestion emplois </h4> </a>
            </div>

            <div>
                <img src="/Assets/imgs/users_icon.png" />
                <a href = "Gestion/Classes.php"> <h4> Gestion classes </h4> </a>
            </div>

            <div>
                <img src="/Assets/imgs/users_icon.png" />
                <a href = "Gestion/Demandes.php"> <h4> Gestion demandes </h4> </a>
            </div> -->
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
    
