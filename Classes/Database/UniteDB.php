<?php
    require_once("MySql.php");

    class UniteDB extends MySql {

        // METHODS
         public function insert($type, $nom, $semestreNum, $planEtudeId) {
            $query = "INSERT INTO unite(type, nom, semestreNum, planEtudeId) VALUES (:type, :nom, :semestreNum, :planEtudeId)"; 
            $secureArray = array( 
                ":type" => $type,
                ":nom" => $nom,
                ":semestreNum" => $semestreNum,
                ":planEtudeId" => $planEtudeId,
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $query = "DELETE FROM unite WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id,
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */

        public function getAllBySemestre($planEtudeID, $semestreNum) {
            return $this->request(
                "SELECT id, nom, type FROM unite WHERE planEtudeID = :planEtudeID AND semestreNum = :semestreNum",
                array(
                    ":planEtudeID" => $planEtudeID,
                    ":semestreNum" => $semestreNum
                ),
                2
            );
        }

        public function getAll($planEtudeID) {
            return $this->request(
                "SELECT id, nom FROM unite WHERE planEtudeID = :planEtudeID",
                array(
                    ":planEtudeID" => $planEtudeID
                ),
                2
            );
        }
    }