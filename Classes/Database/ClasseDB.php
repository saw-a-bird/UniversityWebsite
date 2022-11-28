<?php
    require_once("MySql.php");

    class ClasseDB extends MySql {

        // METHODS
        public function insert($parcoursID, $numero, $anne, $planEtudeID) {
            $query = "INSERT INTO classe(parcoursID, numero, anne, planEtudeID) VALUES (:parcoursID, :numero, :anne, :planEtudeID)"; 
            $secureArray = array( 
                ":parcoursID" => $parcoursID,
                ":numero" => $numero,
                ":anne" => $anne,
                ":planEtudeID" => $planEtudeID
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

        public function exists($parcoursID, $numero, $anne) {
            $query = "SELECT * from classe WHERE parcoursID = :parcoursID AND numero = :numero AND anne = :anne"; 
            $secureArray = array( 
                ":parcoursID" => $parcoursID,
                ":numero" => $numero,
                ":anne" => $anne
            );

            return $this->request($query, $secureArray, 0);
        }

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
                "SELECT c.id as id, c.numero as numero, p.nom as 'parcoursNom', COUNT(g.classeId) as groupes, COUNT(eg.matricule) as etudiants , CONCAT(pe.dateDebut, ' - ', pe.dateFin, ' (#', pe.id, ')') as planEtude
                FROM classe c 
                LEFT JOIN groupe g ON (g.classeId = c.id)
                LEFT JOIN etudiant_group eg ON (eg.groupID = g.id) 

                JOIN parcours p ON (c.parcoursID = p.id)
                JOIN session as s ON (s.anne = c.anne)
                JOIN website_config config ON (config.sessionNumero = s.numero) 
                JOIN planetude pe ON (pe.id = c.planEtudeID)

                WHERE p.departmentID = :departmentID
                GROUP BY c.id",

                array(':departmentID' => $departmentID),
                2
            );
        }
    }