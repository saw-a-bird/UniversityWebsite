<?php
    require_once("MySql.php");
    require_once("Etudiant.php");

    class EtudiantDB extends MySql {

        // METHODS
        public function insert(Etudiant $etd) {
            $query = "INSERT INTO etudiant(matricule, filiereID) VALUES (:matricule, :filiereID)"; 
            $secureArray = array( 
                ":matricule" => $etd->getMatricule(),
                ":filiereID" => $etd->getFiliereID()
            );

            $this->request($query, $secureArray);
        }

        public function update(Etudiant $etd) {
            $query = "UPDATE etudiant SET filiereID = :filiereID WHERE marticule = :marticule"; 
            $secureArray = array( 
                ":filiereID" => $etd->getFiliereID(),
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