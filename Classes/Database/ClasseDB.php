<?php
    require_once("MySql.php");

    class ClasseDB extends MySql {

        // METHODS
        public function insert($parcoursID, $numero, $anne) {
            $query = "INSERT INTO classe(parcoursID, numero, anne) VALUES (:parcoursID, :numero, :anne)"; 
            $secureArray = array( 
                ":parcoursID" => $parcoursID,
                ":numero" => $numero,
                ":anne" => $anne
            );

            $this->request($query, $secureArray);
        }

        
        public function delete($classId) {
            $query = "DELETE FROM classe WHERE id = :classId"; 
            $secureArray = array( 
                ":classId" => $classId
            );

            $this->request($query, $secureArray);
        }
        

        /* QUERY METHODS */
        public function get($classId) {
            return $this->request(
                "SELECT * FROM classe
                JOIN parcours ON (classe.parcoursID = parcours.id)
                WHERE classe.id = :classId",
                array(':classId' => $classId),
                1
            );
        }

        public function getAllByDepartment($departmentID) {
            return $this->request(
                "SELECT c.id as id, c.numero as numero, p.nom as 'parcoursNom', 0 as etudiants FROM classe c 
                JOIN parcours p ON (c.parcoursID = p.id)
                -- LEFT JOIN etudiant_group eg ON (eg.classeID = c.id) COUNT(eg.classeID) 

                JOIN session as s ON (s.anne = c.anne) 
                JOIN website_config config ON (config.sessionNumero = s.numero) 
                
                WHERE p.departmentID = :departmentID
                GROUP BY c.id",

                array(':departmentID' => $departmentID),
                2
            );
        }
    }