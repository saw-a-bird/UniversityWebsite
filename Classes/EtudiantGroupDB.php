<?php
    require_once("MySql.php");
    require_once("Etudiant.php");

    class EtudiantGroupDB extends MySql {

        // METHODS
        public function insert(Etudiant $etd) {
            $query = "INSERT INTO etudiant_group(matricule, groupID) VALUES (:matricule, :groupID)"; 
            $secureArray = array( 
                ":matricule" => $etd->getMatricule(),
                ":groupID" => $etd->getGroupID()
            );

            $this->request($query, $secureArray);
        }

        public function update(Etudiant $etd) {
            $query = "UPDATE etudiant_group SET groupID = :groupID WHERE marticule = :marticule"; 
            $secureArray = array( 
                ":groupID" => $etd->getGroupID(),
                ":marticule" => $etd->getMatricule()
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */
        public function get($matricule) {
            return $this->request(
                "SELECT * FROM etudiant_group WHERE matricule = :matricule",
                array(':matricule' => $matricule),
                1
            );
        }
    }