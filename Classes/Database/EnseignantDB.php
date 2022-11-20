<?php
    require_once("MySql.php");
    require_once("../Enseignant.php");

    class EnseignantDB extends MySql {

        // METHODS
        public function insert(Enseignant $enseignant) {
            $query = "INSERT INTO enseignant(matricule) VALUES (:matricule)"; 
            $secureArray = array( 
                ":matricule" => $enseignant->getMatricule()
            );

            $this->request($query, $secureArray);
        }

        public function update(Enseignant $enseignant) {
            $query = "UPDATE enseignant SET qualifications = :qualifications WHERE marticule = :marticule"; 
            $secureArray = array( 
                ":marticule" => $enseignant->getMatricule(),
                ":qualifications" => $enseignant->getQualifications()
            );

            $this->request($query, $secureArray);
        }
    }