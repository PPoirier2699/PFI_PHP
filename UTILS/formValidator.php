<?php

    class Validator{
        
        static public function validate_email($email)
        {
            $previousPage = $_SERVER["HTTP_REFERER"];

            //coupe le get pour avoir la page qui a dirige vers ici
            $previousPage = substr($previousPage, 0, strpos($previousPage,'?'));
            if(empty($email))
            {
                header('Location: '. $previousPage . '?ErrorMSG=Email%20field%20is%20empty!');
                die();              
            }

            $reg="/^([0-9a-zA-Z]([-\.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/";
            if(!preg_match_all($reg, $email))
            {
                header('Location: '. $previousPage . '?ErrorMSG=This%20is%20not%20an%20email%20adress!');
                die();         
            }
            return false;
        }

        static public function validate_password($password)
        {
            if(empty($password))
            {
                header('Location: '. $previousPage . '?ErrorMSG=Password%20field%20is%20empty!');
                die();       
            }

            $reg1="/[a-z]+/";
            $reg2="/[A-Z]+/";
            $reg3="/[0-9]+/";
            $reg4="/[!@#$%^&*(){}+=|\/]+/";
            $reg5 = "/[\s]/";
        
            //toutes les conditions (si true == condition de fail)
            $message = 'Password%20needs%20to%20have%20at%20least%201%20special%20character,%20one%20capital%20letter%201%20lower%20case%20letter,%20have%201%20number%20and%20be%208%20characters%20long%20minimum!';
            switch(true){
                case(!preg_match($reg1,$password)):
                    header('Location: ../register.php?ErrorMSG='.$message);
                    die();  
                         
                case(!preg_match($reg2,$password)):
                    header('Location: ../register.php?ErrorMSG='.$message);
                    die();  
                
                case(!preg_match($reg3,$password)):
                    header('Location: ../register.php?ErrorMSG='.$message);
                    die();  
                
                case(!preg_match($reg4,$password)):
                    header('Location: ../register.php?ErrorMSG='.$message);
                    die();   
                
                case(preg_match($reg5,$password)):
                    header('Location: ../register.php?ErrorMSG='.$message);
                    die();    
               
                case(strlen($password) < 8):     
                    header('Location: ../register.php?ErrorMSG='.$message);
                    die();               
            }

            //si toutes les conditions de fail ne sont pas satisfaite, retourn true (le password est valide)
            return true;
        }
        public static function sanitize($input){
            $input = stripslashes($input);
            $input = htmlentities($input);
            $input = strip_tags($input);
            return $input;
        }

    }


?>
