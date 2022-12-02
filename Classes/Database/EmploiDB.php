<?php
    require_once("MySql.php");

    class EmploiDB extends MySql {

        // METHODS
        public function insert($groupId, $semestre, $jour, $sceance, $salle, $matiereId, $enseignant) {

            $query = "INSERT INTO  affecter (groupId, semestreNum, jourNum, sceanceNum, salleNom, matiereId, enseignantMatricule) 
            VALUES (:groupId, :semestre, :jour, :sceance, :salle, :matiereId, :enseignant)"; 

            $secureArray = array( 
                ":groupId" => $groupId,
                ":semestre" => $semestre,
                ":jour" => $jour,
                ":sceance" => $sceance,
                ":salle" => $salle,
                ":matiereId" => $matiereId,
                ":enseignant" => $enseignant,
            );

            $this->request($query, $secureArray);
        }

        
        public function delete($id) {
            $query = "DELETE FROM affecter WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id
            );

            $this->request($query, $secureArray);
        }
        

        /* QUERY METHODS */

        // (SELECT s.numero from session s JOIN website_config wc ON (wc.sessionNumero = s.numero)) 
        public function exists($anne, $semestre, $jour, $sceance, $salle) {

            $query = "SELECT classe.id as classeId, groupe.id as groupeId FROM affecter 
            JOIN groupe ON (groupe.id = affecter.groupId)
            JOIN classe ON (classe.id = groupe.classeId AND classe.anne = :anne)
            WHERE semestreNum = :semestre AND jourNum = :jour AND sceanceNum = :sceance AND salleNom = :salle
            GROUP BY groupe.id"; 


            $secureArray = array(
                ":anne" => $anne,
                ":semestre" => $semestre,
                ":jour" => $jour,
                ":sceance" => $sceance,
                ":salle" => $salle
            );

            $response = $this->request($query, $secureArray, 2);

            if (count($response) == 0) {
                return false;
            }

            return $response;
        }

        // public function get($classId) {
        //     return $this->request(
        //         "SELECT * FROM classe
        //         JOIN parcours ON (classe.parcoursID = parcours.id)
        //         WHERE classe.id = :classId",
        //         array(':classId' => $classId),
        //         1
        //     );
        // }

        public function getAll($classeId) {
            return $this->request(
                "SELECT af.id as id, af.salleNom as salle, af.sceanceNum as sceance, af.jourNum as jour, af.groupId as groupe, af.semestreNum as semestre, CONCAT(enseignant.nom, ' ', enseignant.prenom) as enseignant, matiere.nom as matiere FROM affecter af
                JOIN matiere ON (af.matiereId = matiere.id)
                JOIN groupe ON (af.groupId = groupe.id AND groupe.classeId = :classeId)
                JOIN utilisateur as enseignant ON (enseignant.matricule = af.enseignantMatricule)",
                array(
                    ':classeId' => $classeId
                ),
                2
            );
        }

        /* SPECIAL QUERY TYPES */

        public function getAllForStudent($classeId, $groupId) {
            return $this->request(
                "SELECT af.id as id, af.salleNom as salle, af.sceanceNum as sceance, af.jourNum as jour, af.groupId as groupe, af.semestreNum as semestre, CONCAT(enseignant.nom, ' ', enseignant.prenom) as enseignant, matiere.nom as matiere FROM affecter af
                JOIN matiere ON (af.matiereId = matiere.id)
                JOIN groupe ON (af.groupId = groupe.id AND groupe.classeId = :classeId AND groupe.id = :groupId)
                JOIN utilisateur as enseignant ON (enseignant.matricule = af.enseignantMatricule)",
                array(
                    ':classeId' => $classeId,
                    ':groupId' => $groupId,
                ),
                2
            );
        }

        public function getAllForEnseignant($matricule, $semestre) {
            return $this->request(
                "SELECT af.id as id, af.salleNom as salle, af.sceanceNum as sceance, af.jourNum as jour, parcours.nom as classeNom, classe.numero as classeNumero, groupe.numero as groupeNumero, matiere.nom as matiere FROM affecter af

                JOIN matiere ON (af.matiereId = matiere.id)
                JOIN groupe ON (af.groupId = groupe.id)
                JOIN (SELECT * FROM classe where classe.anne = (SELECT anne FROM session JOIN website_config wc ON (session.numero = wc.sessionNumero))) as classe ON (groupe.classeId = classe.id)
                JOIN parcours ON (classe.parcoursID = parcours.id)
                WHERE af.enseignantMatricule = :matricule AND af.semestreNum = :semestre",
                array(
                    ':matricule' => $matricule,
                    ':semestre' => $semestre,
                ),
                2
            );
        }
    }