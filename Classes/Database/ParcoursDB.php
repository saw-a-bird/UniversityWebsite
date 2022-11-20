<?php
    require_once("MySql.php");

    class ParcoursDB extends MySql {

        // METHODS
        public function insert($nom, $filiere, $departmentID) {
            $query = "INSERT INTO parcours(departmentID, nom, filiere) VALUES (:departmentID, :nom, :filiere)"; 
            $secureArray = array( 
                ":departmentID" => $departmentID,
                ":nom" => $nom,
                ":filiere" => $filiere,
            );

            $this->request($query, $secureArray);
        }

        public function update($id, $nom, $filiere) {
            $query = "UPDATE parcours SET nom = :nom, filiere = :filiere WHERE id = :id"; 
            $secureArray = array( 
                ":nom" => $nom,
                ":filiere" => $filiere,
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
                "SELECT * FROM parcours ORDER BY nom",
                array(),
                2
            );
        }

        public function getAllByDepartment($depID) {
            return $this->request(
                "SELECT * FROM parcours 
                WHERE departmentID = :depID
                ORDER BY nom",
                array(
                    ":depID" => $depID
                ),
                2
            );
        }

        public function getAllFilieres() {
            return $this->request(
                "SELECT DISTINCT filiere FROM parcours",
                array(),
                2
            );
        }
    }