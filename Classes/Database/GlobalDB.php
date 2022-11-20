<?php
    require_once("MySql.php");

    class GlobalDB extends MySql {
        // CONFIG METHODS
        public function setInscription($state) {
            $this->request(
                "UPDATE website_config SET inscription = :state", 
                array(":state" => $state)
            );
        }

        public function getInscription() { 
            // checks if inscription is OPEN or CLOSED (boolean)
            
            $result = $this->request(
                "SELECT inscription FROM website_config", 
                array(), 
                1
            );

            return $result["inscription"];
        }

        public function setSession($sessionNumero) {
            $this->request(
                "UPDATE website_config SET sessionNumero = :sessionNumero", 
                array(":sessionNumero" => $sessionNumero)
            );
        }

        public function getSession() { 
            // checks if inscription is OPEN or CLOSED (boolean)
            
            return $this->request(
                    "SELECT numero, anne, semestre FROM website_config
                    JOIN session ON (session.numero = sessionNumero)", 
                    array(), 
                    1
                );
        }
    }