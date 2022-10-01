<?php

    require_once("Utilisateur.php");

    class Etudiant extends Utilisateur {
        private $departmentID;

        public function __construct() {
            $this->role = 3;
        }
        /**
         * Get the value of departmentID
         */ 
        public function getDepartmentID()
        {
                return $this->departmentID;
        }

        /**
         * Set the value of departmentID
         *
         * @return  self
         */ 
        public function setDepartmentID($departmentID)
        {
                $this->departmentID = $departmentID;

                return $this;
        }
    }