<html>
<head>
    <?php
        session_start();
        $securityRoleAbs = 3;
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
        <h1 class = "_block">Bonjour <?= $authName ?> </h1>
        <h2 class = "_block" style = "margin-top: 0">Nom & Prenom: <?= $user["nom"]." ".$user["prenom"] ?></h2>
        <h3>Department: <?= $departmentDB->getNom($user["departmentID"]) ?><br>  </h3>
  
        <div>
            <img src="/Assets/imgs/account_icon.png"> 
            <a href = "/Pages/User/Account/profile.php"> <h4> Consulter votre compte </h4> </a>
        </div>
    </div>

    <div class="image" style = "display:flex; align-items: flex-end;">
        <img src="/Assets/imgs/prof_fm.png"  alt="PC" class="PC"/>
        <img src="/Assets/imgs/prof_m.png" alt="prof_pic" class="prof_pic" style = "height: fit-content;margin-left: auto;"/>
    </div>

</body>
