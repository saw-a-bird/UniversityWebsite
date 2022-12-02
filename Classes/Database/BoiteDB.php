<?php
    require_once("MySql.php");

    class BoiteDB extends MySql {

        // METHODS
        public function insert($senderMatricule, $title, $content) {
            $query = "INSERT INTO message(senderMatricule, title, content) VALUES (:senderMatricule, :title, :content)"; 
            $secureArray = array( 
                ":senderMatricule" => $senderMatricule,
                ":title" => $title,
                ":content" => $content
            );

            return $this->request($query, $secureArray, 3);
        }

        public function update($id, $title, $content) {
            $query = "UPDATE message SET title = :title, content = :content WHERE id = :id"; 
            $secureArray = array( 
                ":id" => $id,
                ":title" => $title,
                ":content" => $content
            );

            $this->request($query, $secureArray);
        }

        public function delete($id) {
            $this->request(
                "DELETE FROM message WHERE id = :id", 
                array( 
                    ":id" => $id,
                )
            ); 
        }

        public function add($matricule, $id) {
            $query = "INSERT INTO user_message(matricule, messageId) VALUES (:matricule, :messageId)"; 
            $secureArray = array( 
                ":matricule" => $matricule,
                ":messageId" => $id,
            );

            $this->request($query, $secureArray);
        }
        

        /* Others */ 

        
        public function setSeen($messageId, $matricule) {
            $query = "UPDATE user_message SET seen = 1 WHERE matricule = :matricule AND messageId = :messageId"; 
            $secureArray = array( 
                ":matricule" => $matricule,
                ":messageId" => $messageId
            );

            $this->request($query, $secureArray);
        }

        public function isSeen($matricule, $id) {
            return $this->request( // if there is a row, then it definitely exists
                "SELECT seen FROM user_message
                WHERE matricule = :matricule AND messageId = :id AND seen = 1",
                array(
                    ':matricule' => $matricule,
                    ':id' => $id
                ),
                0
            );
        }

        public function countUnseen($matricule) {
            return $this->request(
                "SELECT COUNT(messageId) as c FROM user_message
                WHERE matricule = :matricule AND seen = 0",
                array(
                    ':matricule' => $matricule
                ),
                1
            );
        }

          
        public function countCible($messageId) {
            return $this->request(
                "SELECT COUNT(matricule) as c FROM user_message
                WHERE messageId = :messageId",
                array(
                    ':messageId' => $messageId
                ),
                1
            );
        }

        /* VALIDATORS */

        public function isCible($messageId, $matricule) {
            // returns NUMERO, parcoursNom
            return $this->request(
                "SELECT * FROM user_message
                WHERE matricule = :matricule AND messageId = :messageId",
                array(
                    ':matricule' => $matricule,
                    ':messageId' => $messageId
                ),
                0
            );
        }

        public function isCreator($messageId, $matricule) { // gets a group by its id (adds parcours Nom) 
            // returns NUMERO, parcoursNom
            return $this->request(
                "SELECT id  FROM message
                WHERE id = :messageId AND senderMatricule  = :matricule
                ",
                array(
                    ':messageId' => $messageId,
                    ':matricule' => $matricule
                ),
                0
            );
        }

        /*  QUERY METHODS */

        public function get($id) {
            return $this->request(
                "SELECT title, content, date_creation, CONCAT(u.nom, ' ', u.prenom) as sender FROM message
                JOIN utilisateur u ON (message.senderMatricule = u.matricule)
                WHERE message.id = :id",
                array(':id' => $id),
                1
            );
        }
        
        public function getAllCible($messageId) {
            return $this->request(
                "SELECT u.matricule as matricule, CONCAT(u.nom, ' ', u.prenom) as nomprenom, d.nom as departmentNom, u.role as role FROM utilisateur as u
                JOIN department d ON (d.id = u.departmentID)
                JOIN user_message um ON (um.matricule = u.matricule AND um.messageId = :messageId)",
                array(
                    ':messageId' => $messageId
                ),
                2
            );
        }
        
        public function getAllReceived($matricule) {
            return $this->request(
                "SELECT m.id as id, m.title as title, m.date_creation as date_creation, CONCAT(u.nom, ' ', u.prenom) as sender, um.seen as seen FROM user_message um
                JOIN message m ON (m.id = um.messageId)
                JOIN utilisateur u ON (m.senderMatricule = u.matricule)
                WHERE um.matricule = :matricule AND um.messageId = m.id",
                array(
                    ':matricule' => $matricule
                ),
                2
            );
        }

        public function getAllSent($matricule) {
            return $this->request(
                "SELECT m.id as id, m.title as title, m.date_creation as date_creation, count(um.matricule) as vues FROM message m
                LEFT JOIN user_message as um ON (m.id = um.messageId AND um.seen = 1)
                WHERE senderMatricule  = :matricule
                GROUP BY m.id",
                array(':matricule' => $matricule),
                2
            );
        }
    }