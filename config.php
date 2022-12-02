<?php
    // define("HOST", "http://iset.local/");
    define("NOM_SITE", "ISET SOUSSE");
    define("ROOT", $_SERVER['DOCUMENT_ROOT']);

    // site master settings
    define("DEBUG", false);


    //0 -> superadmin, 1 -> director, 2 -> admin, 3 -> enseignant, 4 -> etudiant
    $abilities = array(
        "afficher_emploi" => 4,
        "gestion_emploi" => 2,
        ""
    )
?>