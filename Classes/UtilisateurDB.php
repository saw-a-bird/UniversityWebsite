<?php
    require_once("MySql.php");

    class UtilisateurDB extends MySql {

        /*
            VERIFY AND QUERY METHODS
        */


        public function exists($CIN) {
            return $this->request(
                "SELECT CIN FROM utilisateur WHERE CIN = :CIN",
                array(':CIN' => $CIN),
                0
            );;
        }

        public function emailExists($email, $return = 0) {
            // "Erreur! Cette CIN déja inscrit auparavant!"
            return $this->request(
                "SELECT * FROM utilisateur WHERE email = :email",
                array(':email' => $email),
                $return
            );
        }

        /*
            MAIN CRUD METHODS
        */
        public function insert(Utilisateur $user) {
            $query = "INSERT INTO utilisateur(CIN, nom, prenom, sexe, adresse, dateNaissance, email, departmentID, role, activationCode) VALUES (:CIN, :nom, :prenom, :sexe, :adresse, :dateNaissance, :email, :departmentID, :role, :activationCode)"; 
            $secureArray = array( 
                ":CIN" => $user->getCIN(),
                ":nom" => $user->getNom(),
                ":prenom" => $user->getPrenom(),
                ":sexe" => $user->getSexe(),
                ":adresse" => $user->getAdresse(),
                ":dateNaissance" => $user->getDateNaissance(),
                ":email" => $user->getEmail(),
                ":departmentID" => $user->getDepartmentID(),
                ":role" => $user->getRole(),
                ":activationCode" => $user->getActivationCode(),
            );

            $user->setMatricule($this->request($query, $secureArray, 3));
        }

        public function update(Utilisateur $user) {
            $query = "UPDATE utilisateur SET nom = ?, prenom = ?, sexe = ?, adresse = ?, dateNaissance = ?  WHERE CIN = ?"; 
            $secureArray = array( 
                $user->getNom(),
                $user->getPrenom(),
                $user->getSexe(),
                $user->getAdresse(),
                $user->getDateNaissance(),
                $user->getCIN()
            );

            $this->request($query, $secureArray);
        }
        

        public function delete($matricule) {
            $secureArray = array( 
                ":matricule" => $matricule
            );

            $this->request("DELETE FROM utilisateur WHERE matricule = :matricule", $secureArray);
            
        }

        /* QUERY METHODS */
        public function getAll() {
            return $this->request(
                "SELECT * FROM utilisateur WHERE role <> 0",
                array(),
                2
            );
        }

        public function getList($role, $depId) {
            return $this->request(
                "SELECT * FROM utilisateur WHERE role = :role and departmentID = :depId",
                array(":role" => $role, ":depId" => $depId),
                2
            );
        }

        public function getUserByCIN($cin) {
            return $this->request(
                "SELECT * FROM utilisateur WHERE CIN = :cin",
                array(':cin' => $cin),
                1
            );
        }

        public function getUserByMatricule($matricule) {
            return $this->request(
                "SELECT * FROM utilisateur WHERE matricule = :matricule",
                array(':matricule' => $matricule),
                1
            );
        }

        /*
            SECONDARY CRUD METHODS
        */

        public function verify_activation_code(string $activationCode, string $email) {
            $responseUser = $this->request(
                'SELECT isActive, matricule, activationCode, DATEDIFF(activationExpiry, now()) as isExpired
                 FROM utilisateur
                 WHERE email = :email',
                array( 
                    ":email" => $email
                ),
                1
            );

            if (is_array($responseUser)) {
                
                // error: ALREADY ACTIVE
                if ((int)$responseUser["isActive"] === 1) {
                    return -4;
                }

                // error: ALREADY EXPIRED
                if ((int)$responseUser["isExpired"] === 1) {
                    $this->delete($responseUser['matricule']);
                    return -3;
                }
                
                // verify the password
                if ($activationCode == $responseUser['activationCode']) {
                    return $responseUser; // IF VALID, return user;
                }
            }
            
            return -1; // error: USER NOT FOUND
        }
        

        public function activate_user($matricule, $password) {
            $this->request(
                "UPDATE utilisateur SET isActive = 1, password = :PASS, activationExpiry = NULL WHERE matricule = :matricule",
                array( 
                    ":matricule" => $matricule,
                    ":PASS" => $password
                )
            );
        }
    }