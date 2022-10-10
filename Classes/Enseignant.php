<?php

        require_once("Utilisateur.php");

    class Enseignant extends Utilisateur {
        private $qualifications;

        public function __construct() {
                $this->role = 2;
        }

        /**
         * Get the value of qualifications
         */ 
        public function getQualifications()
        {
                return $this->qualifications;
        }

        /**
         * Set the value of qualifications
         *
         * @return  self
         */ 
        public function setQualifications($qualifications)
        {
                $this->qualifications = $qualifications;

                return $this;
        }
    }
    