<?php
    require_once("MySql.php");

    class EnseignantMatiereDB extends MySql {

        // METHODS
        public function insert($matricule, $matiereId) {
            $query = "INSERT INTO enseignant_matiere(matricule, matiereId) VALUES (:matricule, :matiereId)"; 
            $secureArray = array( 
                ":matricule" => $matricule,
                ":matiereId" => $matiereId
            );

            $this->request($query, $secureArray);
        }

        public function retirer($matricule, $matiereId) {
            $query = "DELETE FROM enseignant_matiere WHERE matricule = :matricule AND matiereId = :matiereId"; 
            $secureArray = array( 
                ":matricule" => $matricule,
                ":matiereId" => $matiereId
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */     
        public function getAll($matiereId) {
            return $this->request(
                "SELECT em.matricule as matricule, CONCAT(u.nom, ' ', u.prenom) as nomprenom FROM enseignant_matiere em
                JOIN utilisateur u ON (u.matricule = em.matricule)
                WHERE em.matiereId = :matiereId
                ORDER BY nomprenom",
                array(':matiereId' => $matiereId),
                2
            );
        }


        /* ADVANCED QUERY METHODS */

        public function available($departmentId, $matiereId) {

            // matricule, nomprenom, class courant, class précedent
            require_once($_SERVER['DOCUMENT_ROOT']."/Classes/Roles.php");
            // return $this->request(
            //         "SELECT u.matricule as matricule, CONCAT(u.nom, ' ', u.prenom) as nomprenom, courant.designation, precedent.designation
            //         FROM utilisateur u
                    
   
                        
                    // LEFT JOIN (SELECT em.matricule as matricule, CONCAT(parcours.nom, '.' , groupe.numero) as designation FROM enseignant_matiere em
                    //     JOIN groupe ON (em.matiereId = groupe.id)
                    //     JOIN classe ON (groupe.classeID = classe.id)
                    //     JOIN session ON (session.id = courant.sessionId - 1)
                    //     JOIN parcours ON (classe.parcoursID = parcours.id)
                    //     WHERE session.id = (SELECT sessionNumero - 1 from website_config)
                    //     GROUP BY em.id) as precedent ON (u.matricule = precedent.matricule)

            //         WHERE u.role = ".Roles::ByName("Etudiant")." AND u.departmentID = :departmentID AND u.isBanned = 1",
                
            //     array(':matiereId' => $matiereId),
            //     2
            // );

            return $this->request(
                    "SELECT u.matricule as matricule, CONCAT(u.nom, ' ', u.prenom) as nomprenom FROM utilisateur u
                    LEFT JOIN enseignant_matiere em ON (em.matricule = u.matricule AND em.matiereId = :matiereId)
                    WHERE u.role = ".Roles::ByName("Enseignant")." AND u.departmentID = :departmentId AND u.isBanned = 0 AND em.matricule is NULL",
                
                array(':departmentId' => $departmentId, ":matiereId" => $matiereId),
                2
            );

            return array();
        }
    }