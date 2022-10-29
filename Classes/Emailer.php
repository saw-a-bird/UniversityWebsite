<?php

    error_reporting(-1); 
    ini_set('display_errors', 'On');
    set_error_handler("var_dump");

    class Emailer {
        const SENDER_EMAIL_ADDRESS = "joe.localhost1@gmail.com";
        private $headers;
        private $recipient;
        private $subject, $message;

        public function __construct($recipient) {
            $this->recipient = $recipient;
            $this->headers  = [
                'MIME-Version' => 'MIME-Version: 1.0',
                'Content-type' => 'text/html; charset=iso-8859-1',
                "From" => self::SENDER_EMAIL_ADDRESS,
                "Reply-To" => $recipient,
                'X-Mailer' => 'PHP/' . phpversion(),
            ];
        }
        
        // private $debug = true;
        function send() {
            
            return mail($this->recipient, $this->subject, nl2br($this->message), $this->headers);
            // if ($this->debug) {
            //     if($return == true) {
            //         print_r('Message was sent SUCCESSFULLY.');
            //     } else {
            //         print_r('MAIL ERROR: '.error_get_last()['message']);
            //     }
            // }
        }

        function create_activation_email() {
            function generate_activation_code(): string {
                return bin2hex(random_bytes(16));
            }

            $activation_code = generate_activation_code();
            // create the activation link
            $activation_link = "http://isetso.local/Pipes/activate.php?email=".$this->recipient."&activation_code=$activation_code";

            // set email subject & body
            $this->subject = 'Veuiller à activer votre compte!';
            $this->message = <<<MESSAGE
                Bonjour!
                Veuillez cliquer sur le lien suivant pour activer votre compte:
                $activation_link
                MESSAGE;

            // send the email
            return $activation_code;
        }
        

        function create_new_password() {
            function create_random_password() {
                $password = ""; //remember to declare $pass as an array
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $password .= $alphabet[$n];
                }
                return $password; //turn the array into a string
            }
            
            $new_password = create_random_password();

            // set email subject & body
            $this->subject = 'Votre mot de passe.';
            $this->message = <<<MESSAGE
                    Bonjour!
                    Votre mot de passe est: $new_password
                    MESSAGE;

            // send the email
            return $new_password;
        }

        
        function email_activation_again($activation_code) {
            $activation_link = "http://isetso.local/Pipes/activate.php?email=".$this->recipient."&activation_code=$activation_code";
            
            // set email subject & body
            $this->subject = 'Veuiller à activer votre compte!';
            $this->message = <<<MESSAGE
                    Rebonjour,
                    Veuillez cliquer sur le lien suivant pour activer votre compte:
                    $activation_link
                    MESSAGE;

        }

        function email_password_again($password) {
    
            // set email subject & body
            $this->subject = 'Votre mot de passe.';
            $this->message = <<<MESSAGE
                    Bonjour,
                    Votre mot de passe: $password
                    MESSAGE;
        }
    }