<?php
    class mySql {
        const _serveur = "localhost";
        const _dbb = "pinteg_universityweb";
        const _login = "root";
        const _mdp = "";

        private static function connect() {
            try {
                $_cnx = new PDO("mysql:host=".self::_serveur.";dbname=".self::_dbb, self::_login, self::_mdp);
                // echo '<br/>connection reussi';
            } catch (PDOException $e) {
                echo '<br/>Echec lors de la connexion: '.$e->getMessage();
                return null;
            }
            return $_cnx;
        }

        // Query EXAMPLE:
        // MySql::request(
        //     "INSERT INTO stars(art_id, acc_id, stars) VALUES (:art_id, :user_id, :stars)",
        //     array(
        //         ':art_id' => $art_id,
        //         ':user_id' => $user_id,
        //         ':stars' => $stars
        //     ),
        //     3 // returns newly inserted ID
        // );
        public static function request($query, $array, $return = false) {
            $ctx = self::connect();
            
            // The prepare function sends a query to the database once and readies itself for user input. You only have to send the variables to it which reduces the brandwidth required.
            $prep = $ctx->prepare($query);

            // Sends the variables to the prepared statement and returns TRUE if statement is logical (valid) - FALSE if not.
            $result = $prep->execute($array);

            if (!$result) {
                die("Statement Error, because ". print_r($ctx->errorInfo(),true)); 
                return false; 
            }

            if ($return === false) { // DEFAULT: just checking if query worked
                return true;
            } else if ($return == 1) { // fetch first element (for SELECT)
                return $prep->rowCount() > 0? $prep->fetch() : -1;
            } else if ($return == 2) { // fetch all elements (for SELECT)
                return $prep->rowCount() > 0? $prep->fetchAll() : -1;
            } else if ($return == 3) { // get last inserted ID (FOR INSERT)
                return $ctx->lastInsertId();
            }
        }
    }

?>