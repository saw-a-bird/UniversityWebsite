<?php
    require_once("MySql.php");

    class ParcoursDB extends MySql {

        // METHODS
         public function new($department_id, $nom) {
            $query = "INSERT INTO parcours(department_id, nom) VALUES (:department_id, :nom)"; 
            $secureArray = array( 
                ":department_id" => $department_id,
                ":nom" => $nom,
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $query = "DELETE FROM parcours WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id,
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */
    
        public function getAll() {
            return $this->request(
                "SELECT * FROM parcours",
                array(),
                2
            );
        }

        public function getAllByDepID($depID) {
            return $this->request(
                "SELECT * FROM parcours WHERE departmentID = :depID",
                array(
                    ":depID" => $depID
                ),
                2
            );
        }
    }