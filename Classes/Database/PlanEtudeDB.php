<?php
    require_once("MySql.php");

    class PlanEtudeDB extends MySql {

        // METHODS
         public function insert($parcoursID, $dateDebut, $dateFin) {
            $query = "INSERT INTO planetude(parcoursID, dateDebut, dateFin) VALUES (:parcoursID, :dateDebut, :dateFin)"; 
            $secureArray = array( 
                ":parcoursID" => $parcoursID,
                ":dateDebut" => $dateDebut,
                ":dateFin" => $dateFin,
            );

            $this->request($query, $secureArray);
        }

        public function update($id, $dateDebut, $dateFin) {
            return $this->request(
                "UPDATE planetude SET dateDebut = :dateDebut, dateFin = :dateFin WHERE id = :id",
                array(
                    ":id" => $id,
                    ":dateDebut" => $dateDebut,
                    ":dateFin" => $dateFin
                )
            );
        }
        public function delete($id) {
            $query = "DELETE FROM planEtude WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id,
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */
    
        public function exists($id) {
            return $this->request(
                "SELECT * FROM planetude WHERE id = :id",
                array(
                    ":id" => $id
                ),
                1
            );
        }

        public function get($id) {
            return $this->request(
                "SELECT pl.id as id, parcoursID, pr.nom as 'parcoursNom', dateDebut, dateFin FROM planetude pl 
                JOIN parcours pr ON (pr.id = pl.parcoursID)
                WHERE pl.id = :id",
                array(
                    ":id" => $id
                ),
                1
            );
        }

        public function getAll() {
            return $this->request(
                "SELECT * FROM planetude",
                array(),
                2
            );
        }

        /* ADVANCED QUERY METHODS */

        public function getAllByDepartmentID($departmentId) {
            return $this->request(
                "SELECT pl.id as id, parcoursID, pr.nom as 'parcoursNom', dateDebut, dateFin FROM planetude pl
                JOIN parcours pr ON (pr.id = pl.parcoursID)
                 WHERE pr.departmentID = :departmentId",
                array(
                    ":departmentId" => $departmentId
                ),
                2
            );
        }

        public function getAllByParcoursID($parcoursId) {
            return $this->request(
                "SELECT pl.id as id, parcoursID, pr.nom as 'parcoursNom', dateDebut, dateFin FROM planetude pl
                JOIN parcours pr ON (pr.id = pl.parcoursID)
                 WHERE pr.id = :parcoursId",
                array(
                    ":parcoursId" => $parcoursId
                ),
                2
            );
        }
    }