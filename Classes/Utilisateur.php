<?php

    class Utilisateur {
        private $CIN;
        private $nom;
        private $prenom;
        private $sexe;
        private $adresse;
        private $dateNaissance;
        private $dateInscription;
        private $email;
        private $role = 0;
        private $numMatricule;
        private $password;
        private $isActive;

        public function getCIN(){
            return $this->CIN;
        }
    
        public function setCIN($CIN){
            $this->CIN = $CIN;
        }
    
        public function getNom(){
            return $this->nom;
        }
    
        public function setNom($nom){
            $this->nom = $nom;
        }
    
        public function getPrenom(){
            return $this->prenom;
        }
    
        public function setPrenom($prenom){
            $this->prenom = $prenom;
        }
    
        public function getSexe(){
            return $this->sexe;
        }
    
        public function setSexe($sexe){
            $this->sexe = $sexe;
        }
    
        public function getAdresse(){
            return $this->adresse;
        }
    
        public function setAdresse($adresse){
            $this->adresse = $adresse;
        }
    
        public function getDateNaissance(){
            return $this->dateNaissance;
        }
    
        public function setDateNaissance($dateNaissance){
            $this->dateNaissance = $dateNaissance;
        }
    
        public function getDateInscription(){
            return $this->dateInscription;
        }
    
        public function setDateInscription($dateInscription){
            $this->dateInscription = $dateInscription;
        }
    
        public function getEmail(){
            return $this->email;
        }
    
        public function setEmail($email){
            $this->email = $email;
        }
    
        public function getRole(){
            return $this->role;
        }

        public function getRoleName(){
            return Roles::getName($this->role);
        }
    
        public function setRole($role){
            $this->role = $role;
        }


    
        public function getNumMatricule(){
            return $this->numMatricule;
        }
    
        public function setNumMatricule($numMatricule){
            $this->numMatricule = $numMatricule;
        }
    
        public function getPassword(){
            return $this->password;
        }
    
        public function setPassword($password){
            $this->password = $password;
        }
    
        public function getIsActive(){
            return $this->isActive;
        }
    
        public function setIsActive($isActive){
            $this->isActive = $isActive;
        }

        /*
            STATIC METHODS
        */

    }