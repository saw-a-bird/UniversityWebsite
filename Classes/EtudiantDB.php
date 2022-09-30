<?php
    require_once("MySql.php");

    class EtudiantDB extends MySql {

        // METHODS
        public static function insert($etd) {
            mySql::start_connection();
            $query = "INSERT INTO etudiant(matricule, department) VALUES (:matricule, :department)"; 
            $secureArray = array( 
                ":matricule" => $etd->getMatricule(),
                ":department" => $etd->getDepartmentID()
            );

            MySql::request($query, $secureArray);
            mySql::close_connection();
        }

        public static function update($etd) {
            mySql::start_connection();
            $query = "UPDATE etudiant SET department = :department WHERE marticule = :marticule"; 
            $secureArray = array( 
                ":department" => $etd->getDepartmentID(),
                ":marticule" => $etd->getMatricule()
            );

            MySql::request($query, $secureArray);
            mySql::close_connection();
        }
    }