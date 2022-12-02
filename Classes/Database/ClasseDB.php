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

        
        public function delete($classeId) {
            $query = "DELETE FROM classe WHERE id = :classeId"; 
            $secureArray = array( 
                ":classeId" => $classeId
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

        public function getAllByDepartmentSimple($departmentID) {
            return $this->request(
                "SELECT c.id as id, CONCAT(p.nom,'.',c.numero) as classe
                FROM classe c 
                JOIN parcours p ON (p.departmentID = :departmentID AND c.parcoursID = p.id)
                JOIN session as s ON (s.anne = c.anne)
                JOIN website_config config ON (config.sessionNumero = s.numero) 
                GROUP BY c.id",

                array(':departmentID' => $departmentID),
                2
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

        /* QUERY METHODS */
        public function getByEtudiant($matricule) {
            return $this->request(
                "SELECT c.id as id, p.nom as parcoursNom, c.numero as classNumero, g.id as groupId, g.numero as groupNumero FROM classe c
                JOIN etudiant_group eg ON (eg.matricule = :matricule)
                JOIN groupe g ON (g.id = eg.groupID)
                JOIN parcours p ON (c.parcoursID = p.id)
                WHERE c.anne = (SELECT anne FROM session JOIN website_config wc ON (session.numero = wc.sessionNumero))",
                array(':matricule' => $matricule),
                1
            );
        }
    }