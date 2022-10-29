<?php

    class Utilisateur {
        
        // regular info
        private $matricule;
        private $CIN;
        private $nom;
        private $prenom;
        private $sexe;
        private $dateNaissance;
        private $adresse;
        private $email;
        private $password;
        private $departmentID;

        // inscription phase
        private $dateInscription;
        private $isConfirmed;
        private $isActive;
        private $activationCode;
        private $activationExpiry;

        // user role
        private $role = 0;

        public function getCIN(){
            return $this->CIN;
        }
    
        public function setCIN($CIN){
            $this->CIN = $CIN;
            return $this;
        }
    
        public function getNom(){
            return $this->nom;
        }
    
        public function setNom($nom){
            $this->nom = $nom;
            return $this;
        }
    
        public function getPrenom(){
            return $this->prenom;
        }
    
        public function setPrenom($prenom){
            $this->prenom = $prenom;
            return $this;
        }
    
        public function getSexe(){
            return $this->sexe;
        }

        static public function getSexeName($sexeID) {
            return $sexeID == 1 ? "Masculin" : "Feminin";
        }
    
        public function setSexe($sexe){
            $this->sexe = $sexe;
            return $this;
        }
    
        public function getAdresse(){
            return $this->adresse;
        }
    
        public function setAdresse($adresse){
            $this->adresse = $adresse;
            return $this;
        }
    
        public function getDateNaissance(){
            return $this->dateNaissance;
        }
    
        public function setDateNaissance($dateNaissance){
            $this->dateNaissance = $dateNaissance;
            return $this;
        }
    
        public function getDateInscription(){
            return $this->dateInscription;
        }
    
        public function setDateInscription($dateInscription){
            $this->dateInscription = $dateInscription;
            return $this;
        }
        
    
        public function getEmail(){
            return $this->email;
        }
    
        public function setEmail($email){
            $this->email = $email;
            return $this;
        }
    
        public function getRole(){
            return $this->role;
        }

        public function getRoleName(){
            return Roles::getName($this->role);
        }
    
        public function setRole($role){
            $this->role = $role;
            return $this;
        }
    
        public function getPassword(){
            return $this->password;
        }
    
        public function setPassword($password){
            $this->password = $password;
            return $this;
        }
    
        public function getIsActive(){
            return $this->isActive;
        }
    
        public function setIsActive($isActive){
            $this->isActive = $isActive;
            return $this;
        }

        /*
            STATIC METHODS
        */


        /**
         * Get the value of matricule
         */ 
        public function getMatricule()
        {
                return $this->matricule;
        }

        /**
         * Set the value of matricule
         *
         * @return  self
         */ 
        public function setMatricule($matricule)
        {
                $this->matricule = $matricule;

                return $this;
        }

        /**
         * Get the value of activationCode
         */ 
        public function getActivationCode()
        {
                return $this->activationCode;
        }

        /**
         * Set the value of activationCode
         *
         * @return  self
         */ 
        public function setActivationCode($activationCode)
        {
                $this->activationCode = $activationCode;

                return $this;
        }

        /**
         * Get the value of activationExpiry
         */ 
        public function getActivationExpiry()
        {
                return $this->activationExpiry;
        }

        /**
         * Set the value of activationExpiry
         *
         * @return  self
         */ 
        public function setActivationExpiry($activationExpiry)
        {
                $this->activationExpiry = $activationExpiry;

                return $this;
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

        /**
         * Get the value of isConfirmed
         */ 
        public function getIsConfirmed()
        {
                return $this->isConfirmed;
        }

        /**
         * Set the value of isConfirmed
         *
         * @return  self
         */ 
        public function setIsConfirmed($isConfirmed)
        {
                $this->isConfirmed = $isConfirmed;

                return $this;
        }
    }