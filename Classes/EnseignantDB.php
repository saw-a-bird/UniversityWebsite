<?php
    require_once("MySql.php");

    class EnseignantDB extends MySql {

        // METHODS
        public static function insert($enseignant) {
            $query = "INSERT INTO enseignant(matricule) VALUES (:matricule)"; 
            $secureArray = array( 
                ":matricule" => $enseignant->getMatricule()
                // ":matiere" => $enseignant->getMatiere()
            );

            MySql::request($query, $secureArray);
        }

        public static function update($enseignant) {
            // $query = "UPDATE enseignant SET matiere = :matiere WHERE marticule = :marticule"; 
            // $secureArray = array( 
            //     ":marticule" => $enseignant->getMatricule()
            //     ":matiere" => $enseignant->getMatiere(),
            // );

            // MySql::request($query, $secureArray);
        }
    }