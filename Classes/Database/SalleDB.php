<?php
    require_once("MySql.php");

    class SalleDB extends MySql {

        // METHODS
        public function insert($nom) {
            $query = "INSERT INTO salle(nom) VALUES (:nom)"; 
            $secureArray = array( 
                ":nom" => $nom
            );

            $this->request($query, $secureArray);
        }

        
        public function delete($nom) {
            $query = "DELETE FROM salle WHERE nom = :nom"; 
            $secureArray = array( 
                ":nom" => $nom
            );

            $this->request($query, $secureArray);
        }
        

        /* QUERY METHODS */
        public function getFilteredByAll($sceance, $jour) {
            return $this->request(
                "SELECT nom, sceanceNum, jourNum FROM salle
LEFT JOIN (SELECT salleNom, sceanceNum, jourNum, groupId FROM affecter WHERE affecter.jourNum = :jour AND affecter.sceanceNum = :sceance) as affecter ON (affecter.salleNom = salle.nom)
LEFT JOIN groupe ON (groupe.id = affecter.groupId)
LEFT JOIN (SELECT id from classe WHERE classe.anne = (SELECT anne FROM session JOIN website_config wc ON (session.numero = wc.sessionNumero))) as classe ON (classe.id = groupe.classeId)
WHERE sceanceNum is NULL AND jourNum IS NULL",
                array(":jour" => $jour, ":sceance" => $sceance),
                2
            );
        }

        public function getFilteredByJour($jour) {
            return $this->request(
                "SELECT nom, sceanceNum, jourNum FROM salle
LEFT JOIN (SELECT salleNom, sceanceNum, jourNum, groupId FROM affecter WHERE affecter.jourNum = :jour) as affecter ON (affecter.salleNom = salle.nom)
LEFT JOIN groupe ON (groupe.id = affecter.groupId)
LEFT JOIN (SELECT id from classe WHERE classe.anne = (SELECT anne FROM session JOIN website_config wc ON (session.numero = wc.sessionNumero))) as classe ON (classe.id = groupe.classeId)
WHERE jourNum IS NULL",
                array(":jour" => $jour),
                2
            );
        }

        public function getFilteredBySceance($sceance) {
            return $this->request(
                "SELECT nom, sceanceNum, jourNum FROM salle
LEFT JOIN (SELECT salleNom, sceanceNum, jourNum, groupId FROM affecter WHERE affecter.sceanceNum = :sceance) as affecter ON (affecter.salleNom = salle.nom)
LEFT JOIN groupe ON (groupe.id = affecter.groupId)
LEFT JOIN (SELECT id from classe WHERE classe.anne = (SELECT anne FROM session JOIN website_config wc ON (session.numero = wc.sessionNumero))) as classe ON (classe.id = groupe.classeId)
WHERE sceanceNum IS NULL",
                array(":sceance" => $sceance),
                2
            );
        }

        public function getAll() {
            return $this->request(
                "SELECT * FROM salle",
                array(),
                2
            );
        }

        public function exists($salleNom) {
            return $this->request(
                "SELECT * FROM salle WHERE nom = :salleNom",
                array("salleNom" => $salleNom),
                0
            );
        }
}