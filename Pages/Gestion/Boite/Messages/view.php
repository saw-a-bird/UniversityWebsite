<!DOCTYPE html>
<head>
    <?php
        session_start();
        $securityRole = 4;
        require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
        include(ROOT."/Pipes/get_login.php");
        if (isset($_GET["from"]) && isset($_GET["id"])) {
            $messageId= $_GET["id"];
            $from = $_GET["from"];
            if (!($from == "inbox" || $from == "sent")) {
                header("location: /Pages/User/index.php");
            }

            require_once(ROOT."/Classes/Database/BoiteDB.php");
            $boiteDB = new BoiteDB();
            
            
            if ($from == "inbox" && !$boiteDB->isCible($messageId, $user["matricule"])) { // if receiver but not cible
                header("location: ../inbox.php");
            } elseif ($from == "sent" && !$boiteDB->isCreator($messageId, $user["matricule"])) { // if sender but not creator
                header("location: ../sent.php");
            }
    
            $message =  $boiteDB->get($messageId);

            $boiteDB->setSeen($messageId, $user["matricule"]);
        } else {
            header("location: /Pages/User/index.php");
        }
    ?>

    <title>Boite - <?= $message["title"] ?> </title>

    <link rel="stylesheet" href="/Assets/css/secondary_form.css">
    <link rel="stylesheet" href="/Assets/css/general.css">
    <link rel="stylesheet" href="/Assets/css/user.css">
    <link rel="stylesheet" href="/Assets/css/boite.css">
</head>
<body>


<div class="logo">  
    <div class = "seperated_div">
        <div class = "header_div">
            <img src="/Assets/imgs/LOGO.png">
            <h2 class = "website_title"> <?= NOM_SITE ?> </h2>
        </div>
        <div class = "buttons_div">
            <h3 class = "go_back"> <a href="../<?= $from ?>.php">Retourner</a></h3>
            <h3 class = "deconnection"> <a href="/Pipes/deconnexion.php">Se deconnecter</a></h3>
        </div>
    </div>
</div>

<div id="messaging_box" style = "top: 20%;">
        <form action="" method="post" id="message_first">
            <div style = "padding-top: 20px;">
                <input type="text" class="lab_in_txt" value = "<?= $message["title"] ?>" disabled style = "font-size: 25px; margin-bottom: 2px; 
    border-bottom-color: #e8e8e8;">
                <input type="text" class="lab_in_txt" value = "Date de creation : <?= $message["date_creation"] ?>" disabled style = "font-size: 12px; display:block; margin-bottom: 40px; border-bottom-color: #e8e8e8;">

                <label for="content" class="lab_form"> Content :</label>
                <textarea id="content" class = "lab_in_textarea" rows="4" cols="50" disabled><?= $message["content"] ?></textarea>

                <div class = "form_btns">
                        
                    <div style = "margin: 40px 25px 20px auto;">
                </div>
            </div>
        </form>
    </div>


</body>
</html>