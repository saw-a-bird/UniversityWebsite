<?php
    abstract class mySql {
        private const _serveur = "localhost";
        private const _dbb = "pinteg_universityweb";
        private const _login = "root";
        private const _mdp = "";
        private static $_cnx;

        public static function start_connection() {
            try {
                self::$_cnx = new PDO("mysql:host=".self::_serveur.";dbname=".self::_dbb, self::_login, self::_mdp);
                
            } catch (PDOException $e) {
                echo '<br/>Echec lors de la connexion: '.$e->getMessage();
                return false;
            }

            return true;
        }

        public static function stop_connection() {
            self::$_cnx = null;
        }

        public static function request($query, $array, $return = false) {
            
            // The prepare function sends a query to the database once and readies itself for user input. You only have to send the variables to it which reduces the brandwidth required.
            $prep = self::$_cnx->prepare($query);

            // Sends the variables to the prepared statement and returns TRUE if statement is logical (valid) - FALSE if not.
            $result = $prep->execute($array);

            if (!$result) {
                die("Statement Error, because ". print_r(self::$_cnx->errorInfo(),true)); 
                return false; 
            }

            if ($return === false) { // DEFAULT: just checking if query worked
                return true;
            } else if ($return == 1) { // fetch first element (for SELECT)
                return $prep->rowCount() > 0? $prep->fetch() : -1;
            } else if ($return == 2) { // fetch all elements (for SELECT)
                return $prep->rowCount() > 0? $prep->fetchAll() : -1;
            } else if ($return == 3) { // get last inserted ID (FOR INSERT)
                return self::$_cnx->lastInsertId();
            }

            /* Query EXAMPLE:
                MySql::request(
                    "INSERT INTO stars(art_id, acc_id, stars) VALUES (:art_id, :user_id, :stars)",
                    array(
                        ':art_id' => $art_id,
                        ':user_id' => $user_id,
                        ':stars' => $stars
                    ),
                    3 // returns newly inserted ID
                ); 
            */
        }

        // public abstract function insert($class);
        // public abstract function update($class);
    }

?>