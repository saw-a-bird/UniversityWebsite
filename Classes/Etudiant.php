<?php

    require_once("Utilisateur.php");

    class Etudiant extends Utilisateur {
        private $filiereID = null;

        public function __construct() {
            $this->role = 3;
        }

        /**
         * Get the value of filiereID
         */ 
        public function getFiliereID()
        {
                return $this->filiereID;
        }

        /**
         * Set the value of filiereID
         *
         * @return  self
         */ 
        public function setFiliereID($filiereID)
        {
                $this->filiereID = $filiereID;

                return $this;
        }
    }