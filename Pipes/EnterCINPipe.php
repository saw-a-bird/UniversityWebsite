<?php 

    session_start();

    $cin = $_POST["INSCRIPTION_CIN"];
    require_once("../Classes/UtilisateurDB.php");

    if (UtilisateurDB::userExists($cin)) {
        echo "Erreur! Cette CIN déja inscrit auparavant!";
    } else {
        $result = UtilisateurDB::listeExists($cin);
        if ($result == false) {
            echo "Erreur! Cette CIN n'existe pas dans la liste!";
        } else {
            echo $result;
        }
    }
?>