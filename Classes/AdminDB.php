<?php
    require_once("MySql.php");

    class AdminDB extends MySql {

        // METHODS
        public function changeIState() {
            MySql::request(
                "UPDATE website_config SET allowInscription = NOT allowInscription", array()
            );
        }

         public function addToList($cin, $nomprenom, $role) {
            $query = "INSERT INTO liste_inscription(cin, :nomprenom, role) VALUES (:cin, :nomprenom, :role)"; 
            $secureArray = array( 
                ":cin" => $cin,
                ":nomprenom" => $nomprenom,
                ":role" => $role
            );

            MySql::request($query, $secureArray);
        }

        public function removeFromList($cin) {
            $query = "DELETE FROM liste_inscription WHERE cin = :cin"; 
            $secureArray = array( 
                ":cin" => $cin
            );

            MySql::request($query, $secureArray);
        }

        public function clearList() {
            MySql::request("TRUNCATE TABLE liste_inscription", array());
        }

        /* QUERY LIST */

        public function getIList() {
            return MySql::request("SELECT * from liste_inscription", array(), 2);
        }
    }