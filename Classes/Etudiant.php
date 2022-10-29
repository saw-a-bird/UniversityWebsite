<?php

    require_once("Utilisateur.php");

    class Etudiant extends Utilisateur {
        private $groupID = null;

        /**
         * Get the value of groupID
         */ 
        public function getGroupID()
        {
                return $this->groupID;
        }

        /**
         * Set the value of groupID
         *
         * @return  self
         */ 
        public function setGroupID($groupID)
        {
                $this->groupID = $groupID;

                return $this;
        }
    }