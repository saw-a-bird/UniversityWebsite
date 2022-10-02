<?php
    require_once("MySql.php");

    class EtudiantDB extends MySql {

        // METHODS
        public function insert($etd) {
            $query = "INSERT INTO etudiant(matricule, department) VALUES (:matricule, :department)"; 
            $secureArray = array( 
                ":matricule" => $etd->getMatricule(),
                ":department" => $etd->getDepartmentID()
            );

            $this->request($query, $secureArray);
        }

        public function update($etd) {
            $query = "UPDATE etudiant SET department = :department WHERE marticule = :marticule"; 
            $secureArray = array( 
                ":department" => $etd->getDepartmentID(),
                ":marticule" => $etd->getMatricule()
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */
        public function get($matricule) {
            return $this->request(
                "SELECT * FROM etudiant WHERE matricule = :matricule",
                array(':matricule' => $matricule),
                1
            );
        }
    }