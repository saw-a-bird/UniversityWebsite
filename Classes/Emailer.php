<?php

    class Emailer {
        const SENDER_EMAIL_ADDRESS = "joe.localhost1@gmail.com";
        const EMAIL_HEADERS = "From: ". self::SENDER_EMAIL_ADDRESS;
        private $recipient;

        public function __construct($recipient) {
            $this->recipient = $recipient;
        }
        
        private $debug = true;
        function send($subject, $message) {
            $return = mail($this->recipient, $subject, nl2br($message), self::EMAIL_HEADERS);
            // if ($this->debug) {
            //     if($return == true) {
            //         print_r('Message was sent SUCCESSFULLY.');
            //     } else {
            //         print_r('MAIL ERROR: '.error_get_last()['message']);
            //     }
            // }

        }

        function send_activation_email() {
            function generate_activation_code(): string {
                return bin2hex(random_bytes(16));
            }

            $activation_code = generate_activation_code();
            // create the activation link
            $activation_link = "http://localhost/teamworkProj/Pipes/activate.php?email=".$this->recipient."&activation_code=$activation_code";

            // set email subject & body
            $subject = 'Please activate your account';
            $message = <<<MESSAGE
                    Hi,
                    Please click the following link to activate your account:
                    $activation_link
                    MESSAGE;

            // send the email
            $this->send($subject, $message);
            return $activation_code;
        }
        

        function send_new_password() {
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
            $subject = 'Your new password.';
            $message = <<<MESSAGE
                    Hi,
                    Your password is: $new_password
                    MESSAGE;

            // send the email
            $this->send($subject, $message);
            return $new_password;
        }
    }