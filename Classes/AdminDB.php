<?php
    require_once("MySql.php");

    class AdminActionsDB extends MySql {

        // METHODS
        public static function changeIState() {
            MySql::request(
                "UPDATE website_config SET allowInscription = NOT allowInscription", array()
            );
        }

         public static function addToList($cin, $role) {
            $query = "INSERT INTO list_inscription(cin, role) VALUES (:cin, :role)"; 
            $secureArray = array( 
                ":cin" => $cin,
                ":role" => $role
            );

            MySql::request($query, $secureArray);
        }

        public static function removeFromList($cin) {
            $query = "DELETE FROM list_inscription WHERE cin = :cin"; 
            $secureArray = array( 
                ":cin" => $cin
            );

            MySql::request($query, $secureArray);
        }

        public static function clearList() {
            MySql::request("TRUNCATE TABLE list_inscription", array());
        }
    }