<?php
    require_once("MySql.php");

    class AdminActionsDB extends MySql {

        // METHODS
        public static function changeIState() {
            mySql::start_connection();
            MySql::request(
                "UPDATE website_config SET allowInscription = NOT allowInscription", array()
            );
            mySql::stop_connection();
        }

         public static function addToList($cin, $role) {
            mySql::start_connection();
            $query = "INSERT INTO list_inscription(cin, roleID) VALUES (:cin, :roleID)"; 
            $secureArray = array( 
                ":cin" => $cin,
                ":roleID" => $role
            );

            MySql::request($query, $secureArray);
            mySql::stop_connection();
        }

        public static function removeFromList($cin) {
            mySql::start_connection();
            $query = "DELETE FROM list_inscription WHERE cin = :cin"; 
            $secureArray = array( 
                ":cin" => $cin
            );

            MySql::request($query, $secureArray);
            mySql::stop_connection();
        }

        public static function clearList() {
            mySql::start_connection();
            MySql::request("TRUNCATE TABLE list_inscription", array());
            mySql::stop_connection();
        }
    }