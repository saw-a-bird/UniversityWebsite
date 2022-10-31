<?php
    require_once("MySql.php");

    class InscriptionDB extends MySql {

        // CONFIG METHODS
        public function changeIState($state) {
            $this->request(
                "UPDATE website_config SET inscription = :state", 
                array(":state" => $state)
            );
        }

        public function getIState() { 
            // checks if inscription is OPEN or CLOSED (boolean)
            
            $result = $this->request(
                "SELECT inscription FROM website_config", 
                array(), 
                1
            );

            return $result["inscription"];
        }

        // CRUD METHODS

        public function get($id) {
            return $this->request(
                "SELECT * FROM liste_inscription WHERE id = :id",
                array(':id' => $id),
                1
            );
        }

        public function getAll() {
            return $this->request("
            SELECT l.id, l.cin as cin, nomprenom, role, departmentID, case when u.CIN is NULL THEN 0 ELSE 1 END as isSubscribed
            FROM liste_inscription as l
            LEFT JOIN (
                SELECT cin
                FROM utilisateur
            ) as u ON u.CIN = l.cin", array(), 2);
        }

         public function insert($cin, $nomprenom, $departmentID, $role) {
            $query = "INSERT INTO liste_inscription(cin, nomprenom, departmentID, role) VALUES (:cin, :nomprenom, :departmentID, :role)"; 
            $secureArray = array( 
                ":cin" => $cin,
                ":nomprenom" => $nomprenom,
                ":departmentID" => $departmentID,
                ":role" => $role
            );

            $this->request($query, $secureArray);
        }

        public function update($oldcin, $newcin, $nomprenom, $departmentID, $role) {
            $query = "UPDATE liste_inscription SET cin = :newcin, nomprenom = :nomprenom, departmentID = :departmentID, role = :role WHERE cin = :oldcin"; 

            $secureArray = array( 
                ":newcin" => $newcin,
                ":nomprenom" => $nomprenom,
                ":role" => $role,
                ":departmentID" => $departmentID,
                ":oldcin" => $oldcin
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $query = "DELETE FROM liste_inscription WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id
            );

            $this->request($query, $secureArray);
        }

        public function clear() {
            $this->request("TRUNCATE TABLE liste_inscription", array());
        }

        /* QUERY LIST */

        public function exists($CIN) {
            return $this->request(
                "SELECT * FROM liste_inscription WHERE CIN = :CIN",
                array(':CIN' => $CIN),
                0
            );
        }

        public function getInfo($cin) {
            return $this->request(
                "SELECT departmentID, role FROM liste_inscription WHERE cin = :cin",
                array(':cin' => $cin),
                1
            );
        }
    }
    
?>