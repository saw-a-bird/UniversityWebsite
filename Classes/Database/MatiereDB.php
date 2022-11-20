<?php
    require_once("MySql.php");

    class MatiereDB extends MySql {

        // METHODS
        public function insert($nom, $coeff, $credit,  $heursCours, $heursTP, $uniteID) {
            $query = "INSERT INTO matiere(nom, coefficient_mat, credit_mat, heursCours, heursTP, uniteID) VALUES (:nom, :coeff, :credit, :heursCours, :heursTP, :uniteID)"; 
            $secureArray = array( 
                ":nom" => $nom,
                ":coeff" => $coeff,
                ":credit" => $credit,
                ":heursCours" => $heursCours,
                ":heursTP" => $heursTP,
                ":uniteID" => $uniteID,
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $query = "DELETE FROM matiere WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id,
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */

        public function getAll($uniteID) {
            return $this->request(
                "SELECT id,nom,coefficient_mat,credit_mat,heursCours,heursTP FROM matiere WHERE uniteID = :uniteID",
                array(
                    ":uniteID" => $uniteID
                ),
                2
            );
        }
    }