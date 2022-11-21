<?php
    require_once("MySql.php");

    class SalleDB extends MySql {

        // METHODS
        public function insert($nom) {
            $query = "INSERT INTO salle(nom) VALUES (:nom)"; 
            $secureArray = array( 
                ":nom" => $nom
            );

            $this->request($query, $secureArray);
        }

        
        public function delete($nom) {
            $query = "DELETE FROM salle WHERE nom = :nom"; 
            $secureArray = array( 
                ":nom" => $nom
            );

            $this->request($query, $secureArray);
        }
        

        /* QUERY METHODS */
        public function getAll() {
            return $this->request(
                "SELECT * FROM salle",
                array(),
                2
            );
        }

        public function exists($salleNom) {
            return $this->request(
                "SELECT * FROM salle WHERE nom = :salleNom",
                array("salleNom" => $salleNom),
                0
            );
        }
}