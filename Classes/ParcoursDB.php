<?php
    require_once("MySql.php");

    class ParcoursDB extends MySql {

        // METHODS
        public function insert($nom, $departmentID) {
            $query = "INSERT INTO parcours(departmentID, nom) VALUES (:departmentID, :nom)"; 
            $secureArray = array( 
                ":departmentID" => $departmentID,
                ":nom" => $nom,
            );

            $this->request($query, $secureArray);
        }

        public function update($id, $nom) {
            $query = "UPDATE parcours SET nom = :nom WHERE id = :id"; 
            $secureArray = array( 
                ":nom" => $nom,
                ":id" => $id
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $query = "DELETE FROM parcours WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id,
            );

            return $this->request($query, $secureArray);
        }


        /* QUERY METHODS */

        public function nomExists($nom) {
            return $this->request(
                "SELECT * FROM parcours WHERE nom = :nom",
                array(
                    ":nom" => $nom
                ),
                0
            );
        }

        public function get($id) {
            return $this->request(
                "SELECT * FROM parcours WHERE id = :id",
                array(
                    ":id" => $id
                ),
                1
            );
        }
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