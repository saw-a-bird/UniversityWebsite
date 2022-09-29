<?php
    require_once("MySql.php");

    class EtudiantDB extends MySql {

        // METHODS
        public static function insert($etd) {
            mySql::start_connection();
            $query = "INSERT INTO etudiant(CIN, filiere, department) VALUES (:CIN, :filiere, :department)"; //isActive for later
            $secureArray = array( 
                ":CIN" => $etd->CIN,
                ":departmentID" => $etd->departmentID,
                ":filiereID" => $etd->filiereID
            );

            MySql::request($query, $secureArray);
            mySql::stop_connection();
        }

        public static function update($user) {
            mySql::start_connection();
            $query = "UPDATE etudiant SET filiereID = ?, departmentID = ? WHERE CIN = ?"; //isActive for later
            $secureArray = array( 
                $user->filiereID,
                $user->departmentID,
                $user->CIN
            );

            MySql::request($query, $secureArray);
            mySql::stop_connection();
        }
    }