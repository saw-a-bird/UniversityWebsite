<?php
    require_once("MySql.php");

    class AdminDB extends MySql {

        // METHODS
        public function changeIState($state) {
            $this->request(
                "UPDATE website_config SET inscription = :state", 
                array(":state" => $state)
            );
        }

         public function addToList($cin, $nomprenom, $role) {
            $query = "INSERT INTO liste_inscription(cin, :nomprenom, role) VALUES (:cin, :nomprenom, :role)"; 
            $secureArray = array( 
                ":cin" => $cin,
                ":nomprenom" => $nomprenom,
                ":role" => $role
            );

            $this->request($query, $secureArray);
        }

        public function removeFromList($cin) {
            $query = "DELETE FROM liste_inscription WHERE cin = :cin"; 
            $secureArray = array( 
                ":cin" => $cin
            );

            $this->request($query, $secureArray);
        }

        public function clearList() {
            $this->request("TRUNCATE TABLE liste_inscription", array());
        }

        /* QUERY LIST */

        public function getIList() {
            return $this->request("SELECT * from liste_inscription", array(), 2);
        }
    }