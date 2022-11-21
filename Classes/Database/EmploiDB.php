<?php
    require_once("MySql.php");

    class EmploiDB extends MySql {

        // METHODS
        // public function insert($parcoursID, $numero, $anne) {
        //     $query = "INSERT INTO classe(parcoursID, numero, anne) VALUES (:parcoursID, :numero, :anne)"; 
        //     $secureArray = array( 
        //         ":parcoursID" => $parcoursID,
        //         ":numero" => $numero,
        //         ":anne" => $anne
        //     );

        //     $this->request($query, $secureArray);
        // }

        
        // public function delete($classId) {
        //     $query = "DELETE FROM classe WHERE id = :classId"; 
        //     $secureArray = array( 
        //         ":classId" => $classId
        //     );

        //     $this->request($query, $secureArray);
        // }
        

        /* QUERY METHODS */
        // public function get($classId) {
        //     return $this->request(
        //         "SELECT * FROM classe
        //         JOIN parcours ON (classe.parcoursID = parcours.id)
        //         WHERE classe.id = :classId",
        //         array(':classId' => $classId),
        //         1
        //     );
        // }

        public function getAll($classeId, $semestreNum) {
            return $this->request(
                "SELECT * FROM affecter af
                JOIN matiere ON (af.matiereId = matiere.id)
                JOIN groupe ON (af.groupId = groupe.id AND groupe.classeId = :classeId)
                JOIN utilisateur as enseignant ON (enseignant.matricule = af.enseignantMatricule)
                WHERE semestreNum = :semestreNum",
                array(
                    ':classeId' => $classeId,
                    'semestreNum' => $semestreNum
                ),
                2
            );
        }
    }