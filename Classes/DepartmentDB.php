<?php
    require_once("MySql.php");

    class DepartmentDB extends MySql {

        // METHODS
         public static function insert($dep) {
            $query = "INSERT INTO department(nom) VALUES (:nom)"; 
            $secureArray = array( 
                ":nom" => $dep->getNom(),
            );

            MySql::request($query, $secureArray);
        }
    }