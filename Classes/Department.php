<?php


    class Department {
        private $id;
        private $nom;

        
        /**
         * Get ID of department
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the ID of department
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
        
        /**
         * Get name of department
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set name of department
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $this;
        }
    }