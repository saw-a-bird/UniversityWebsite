<?php
    require_once("MySql.php");

    class EtudiantGroupDB extends MySql {

        // METHODS
        public function insert($matricule, $groupeId) {
            $query = "INSERT INTO etudiant_group(matricule, groupID) VALUES (:matricule, :groupeId)"; 
            $secureArray = array( 
                ":matricule" => $matricule,
                ":groupeId" => $groupeId
            );

            $this->request($query, $secureArray);
        }

        public function retirer($matricule, $groupeId) {
            $query = "DELETE FROM etudiant_group WHERE matricule = :matricule AND groupID = :groupeId"; 
            $secureArray = array( 
                ":matricule" => $matricule,
                ":groupeId" => $groupeId
            );

            $this->request($query, $secureArray);
        }

        /* QUERY METHODS */     
        public function getAll($groupeId) {
            return $this->request(
                "SELECT eg.matricule as matricule, CONCAT(u.nom, ' ', u.prenom) as nomprenom FROM etudiant_group eg
                JOIN utilisateur u ON (u.matricule = eg.matricule)
                WHERE eg.groupID = :groupeId
                ORDER BY nomprenom",
                array(':groupeId' => $groupeId),
                2
            );
        }


        /* ADVANCED QUERY METHODS */

        public function availableByDepartment($departmentId) {

            // matricule, nomprenom, class courant, class précedent
            require_once($_SERVER['DOCUMENT_ROOT']."/Classes/Roles.php");
            // return $this->request(
            //         "SELECT u.matricule as matricule, CONCAT(u.nom, ' ', u.prenom) as nomprenom, courant.designation, precedent.designation
            //         FROM utilisateur u
                    
   
                        
                    // LEFT JOIN (SELECT eg.matricule as matricule, CONCAT(parcours.nom, '.' , groupe.numero) as designation FROM etudiant_group eg
                    //     JOIN groupe ON (eg.groupID = groupe.id)
                    //     JOIN classe ON (groupe.classeID = classe.id)
                    //     JOIN session ON (session.id = courant.sessionId - 1)
                    //     JOIN parcours ON (classe.parcoursID = parcours.id)
                    //     WHERE session.id = (SELECT sessionNumero - 1 from website_config)
                    //     GROUP BY eg.id) as precedent ON (u.matricule = precedent.matricule)

            //         WHERE u.role = ".Roles::ByName("Etudiant")." AND u.departmentID = :departmentID AND u.isBanned = 1",
                
            //     array(':groupeId' => $groupeId),
            //     2
            // );

            return $this->request(
                    "SELECT u.matricule as matricule, CONCAT(u.nom, ' ', u.prenom) as nomprenom
                    FROM utilisateur u
                    LEFT JOIN (SELECT eg.matricule as matricule, CONCAT(parcours.nom, '.' , groupe.numero) as designation FROM etudiant_group eg
                        JOIN groupe ON (eg.groupID = groupe.id)
                        JOIN classe ON (groupe.classeID = classe.id)
                        JOIN session ON (session.anne = classe.anne)
                        JOIN parcours ON (classe.parcoursID = parcours.id)
                        WHERE session.numero = (SELECT sessionNumero from website_config)) as courant ON (u.matricule = courant.matricule)
                    WHERE u.role = ".Roles::ByName("Etudiant")." AND u.departmentID = :departmentId AND u.isBanned = 0 AND courant.designation is NULL",
                
                array(':departmentId' => $departmentId),
                2
            );

            return array();
        }
    }