<?php
    require_once("MySql.php");
    require_once("Etudiant.php");

    class EtudiantDB extends MySql {

        // METHODS
        public function insert(Etudiant $etd) {
            $query = "INSERT INTO etudiant(matricule, groupID) VALUES (:matricule, :groupID)"; 
            $secureArray = array( 
                ":matricule" => $etd->getMatricule(),
                ":groupID" => $etd->getGroupID()
            );

            $this->request($query, $secureArray);
        }

        public function update(Etudiant $etd) {
            $query = "UPDATE etudiant SET groupID = :groupID WHERE marticule = :marticule"; 
            $secureArray = array( 
                ":groupID" => $etd->getGroupID(),
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