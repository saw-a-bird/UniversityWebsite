<?php
    require_once("MySql.php");

    class GroupeDB extends MySql {

        // METHODS
        public function insert($classeId, $numero) {
            $query = "INSERT INTO groupe(classeId, numero) VALUES (:classeId, :numero)"; 
            $secureArray = array( 
                ":classeId" => $classeId,
                ":numero" => $numero
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $groupe = $this->getSimple($id);
            $this->decrementNumberAfter($groupe["numero"], $groupe["classeId"]);
            
            $this->request(
                "DELETE FROM groupe WHERE id = :id", 
                array( 
                    ":id" => $id,
                )
            );

            
        }

        public function decrementNumberAfter($numero, $classeId) {
            return $this->request(
                "UPDATE groupe SET numero = numero - 1 WHERE numero > :numero AND classeId = :classeId", 
                array( 
                    ":numero" => $numero,
                    ":classeId" => $classeId
                )
            );
        }

        
        /* QUERY METHODS */
        
        public function getSimple($groupeId) {
            return $this->request(
                "SELECT numero, classeId FROM groupe
                WHERE id = :groupeId",
                array(':groupeId' => $groupeId),
                1
            );
        }

        public function get($groupeId) { // gets a group by its id (adds parcours Nom) 

            // returns NUMERO, parcoursNom
            return $this->request(
                "SELECT g.numero as numero, p.nom as parcoursNom, c.id as classeID FROM groupe g
                JOIN classe c ON (g.classeId = c.id)
                JOIN parcours p ON (c.parcoursID = p.id)
                WHERE g.id = :groupeId",
                array(':groupeId' => $groupeId),
                1
            );
        }

        public function getAllSimple($classeId) {
            return $this->request(
                "SELECT id, numero FROM groupe
                WHERE classeId = :classeId
                ORDER BY numero",
                array(':classeId' => $classeId),
                2
            );
        }

        public function getAll($classeId) {
            return $this->request(
                "SELECT id, numero, COUNT(eg.groupID) as nombreEtudiant FROM groupe g
                LEFT JOIN etudiant_group eg ON (eg.groupID = g.id)
                WHERE g.classeID = :classeId
                GROUP BY g.id",
                array(':classeId' => $classeId),
                2
            );
        }
    }