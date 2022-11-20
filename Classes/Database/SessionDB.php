<?php
    require_once("MySql.php");

    class SessionDB extends MySql {

        // METHODS
        public function insert($semestre, $anne) {
            $query = "INSERT INTO session(semestre, anne) VALUES (:semestre, :anne)"; 
            $secureArray = array( 
                ":semestre" => $semestre,
                ":anne" => $anne,
            );

            $this->request($query, $secureArray);
        }

        public function update($numero, $semestre, $anne) {
            $query = "UPDATE session SET semestre = :semestre, anne = :anne WHERE numero = :numero"; 
            $secureArray = array( 
                ":numero" => $numero,
                ":semestre" => $semestre,
                ":anne" => $anne,
            );

            return $this->request($query, $secureArray);
        }

        public function delete($numero) {
            $query = "DELETE FROM session WHERE numero = :numero"; 
            $secureArray = array( 
                ":numero" => $numero,
            );

            return $this->request($query, $secureArray);
        }

        /* QUERY METHODS */

        public function exists($semestre, $anne) {
            return $this->request(
                "SELECT numero FROM session WHERE semestre = :semestre AND anne = :anne ",
                array(
                    ":semestre" => $semestre,
                    ":anne" => $anne
                ),
                1
            );
        }

        public function get($numero) {
            return $this->request(
                "SELECT * FROM session WHERE numero = :numero",
                array(
                    ":numero" => $numero
                ),
                1
            );
        }

        public function getAll() {
            return $this->request(
                "SELECT * FROM session",
                array(),
                2
            );
        }


        /* ADVANCED QUERY METHODS */

        
        public function countByAnne($anne) {
            return $this->request(
                "SELECT count(*) as c FROM session WHERE anne = :anne ",
                array(
                    ":anne" => $anne
                ),
                1
            );
        }
    }