<?php

    class Enseignant {
        private $matiere;

        /**
         * Get the value of matiere
         */ 
        public function getMatiere()
        {
                return $this->matiere;
        }

        /**
         * Set the value of matiere
         *
         * @return  self
         */ 
        public function setMatiere($matiere)
        {
                $this->matiere = $matiere;

                return $this;
        }
    }
    