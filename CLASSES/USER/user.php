<?php

include_once __DIR__ . "/userTDG.php";

class User{

    private $id;
    private $email;
    private $username;
    private $password;
    private $profilePictureURL;

    /*
        utile si on utilise un factory pattern
    */
    public function __construct(){
        //$this->id = $id;
        //$this->email = $email;
        //$this->username = $username;
        //$this->password = $password;
        //$this->TDG = new UserTDG;
    }


    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_profilePictureURL (){
        return $this->profilePictureURL;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_password(){
        return $this->password;
    }


    //setters
    public function set_email($email){
        $this->email = $email;
    }

    public function set_profilePictureURL($profilePictureURL){
        $this->profilePictureURL = $profilePictureURL;
    }

    public function set_username($username){
        $this->username = $username;
    }

    public function set_password($password){
        $this->password = $password;
    }


    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_user($email){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->password = $res['password'];
        $this->profilePictureURL = $res['profilePictureURL'];
        
        $TDG = null;
        return true;
    }


    //Login Validation
    public function Login($email, $pw){
        
        // Regarde si l'utilisateur existes deja
        if(!$this->load_user($email))
        {
            return false;
        }
        
        // Regarde si le password est verifiable
        if(!password_verify($pw, $this->password))
        {
            return false;
        }

        // set session variables
        $_SESSION["userID"] = $this->id;
        $_SESSION["userEmail"] = $this->email;
        $_SESSION["userName"] = $this->username;

        return true;
    }


    //Register Validation
    public function validate_register($email){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }


    public function register($email, $username, $pw, $vpw,$profilePictureURL){
        
        //check is both password are equals
        if(!($pw === $vpw) || empty($pw) || empty($vpw))
        {
            return false;
        }

        //check if user exists
        if(!$this->validate_register($email, $pw))
        {
            return false;
        }

        //add user to DB
        $TDG = UserTDG::getInstance();
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT),$profilePictureURL);
        $TDG = null;
        return true;
    }
}


