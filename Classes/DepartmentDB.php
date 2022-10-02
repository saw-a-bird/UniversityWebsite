<?php
    require_once("MySql.php");

    class DepartmentDB extends MySql {

        // METHODS
         public function insert($dep) {
            $query = "INSERT INTO department(nom) VALUES (:nom)"; 
            $secureArray = array( 
                ":nom" => $dep->getNom(),
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $query = "DELETE FROM department WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id,
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */
        public function getNom($id) {
            $query = "SELECT nom from department"; 
            $secureArray = array( 
                ":id" => $id,
            );

            return $this->request($query, $secureArray, 1)["nom"];
        }
    }