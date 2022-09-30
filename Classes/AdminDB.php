<?php
    require_once("MySql.php");

    class AdminActionsDB extends MySql {

        // METHODS
        public static function changeIState() {
            mySql::start_connection();
            MySql::request(
                "UPDATE website_config SET allowInscription = NOT allowInscription", array()
            );
            mySql::close_connection();
        }

         public static function addToList($cin, $role) {
            mySql::start_connection();
            $query = "INSERT INTO list_inscription(cin, role) VALUES (:cin, :role)"; 
            $secureArray = array( 
                ":cin" => $cin,
                ":role" => $role
            );

            MySql::request($query, $secureArray);
            mySql::close_connection();
        }

        public static function removeFromList($cin) {
            mySql::start_connection();
            $query = "DELETE FROM list_inscription WHERE cin = :cin"; 
            $secureArray = array( 
                ":cin" => $cin
            );

            MySql::request($query, $secureArray);
            mySql::close_connection();
        }

        public static function clearList() {
            mySql::start_connection();
            MySql::request("TRUNCATE TABLE list_inscription", array());
            mySql::close_connection();
        }
    }