<?php

include_once __DIR__ . "/userTDG.php";

class User
{

    private $id;
    private $email;
    private $username;
    private $password;
    private $profilePictureURL;

    /*
        utile si on utilise un factory pattern
    */
    public function __construct()
    {
        //$this->id = $id;
        //$this->email = $email;
        //$this->username = $username;
        //$this->password = $password;
        //$this->TDG = new UserTDG;
    }


    //getters
    public function get_id()
    {
        return $this->id;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_profilePictureURL()
    {
        return $this->profilePictureURL;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function get_password()
    {
        return $this->password;
    }


    //setters
    public function set_email($email)
    {
        $this->email = $email;
    }

    public function set_profilePictureURL($profilePictureURL)
    {
        $this->profilePictureURL = $profilePictureURL;
    }

    public function set_username($username)
    {
        $this->username = $username;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }


    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_user($email)
    {
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);

        if (!$res) {
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
    public function Login($email, $pw)
    {

        // Regarde si l'utilisateur existes deja
        if (!$this->load_user($email)) {
            return false;
        }

        // Regarde si le password est verifiable
        if (!password_verify($pw, $this->password)) {
            return false;
        }

        // set session variables
        $_SESSION["userID"] = $this->id;
        $_SESSION["userEmail"] = $this->email;
        $_SESSION["userName"] = $this->username;
        $_SESSION["profilePicPath"] = $this->profilePictureURL;

        return true;
    }


    //Register Validation
    public function validate_register($email)
    {
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if ($res) {
            return false;
        }

        return true;
    }


    public function register($email, $username, $pw, $vpw, $profilePictureURL)
    {

        //check is both password are equals
        if (!($pw === $vpw) || empty($pw) || empty($vpw)) {
            return false;
        }

        //check if the image is a fake image
        if (!getimagesize($profilePictureURL['tmp_name'])) {
            return false;
        }

        //check if user exists
        if (!$this->validate_register($email, $pw)) {
            return false;
        }
        $target_dir = "IMG/";

        //obtenir l'extention du fichier uploader
        $media_file_type = pathinfo($profilePictureURL['name'], PATHINFO_EXTENSION);

        // Valid file extensions
        $img_extensions_arr = array("jpg", "jpeg", "png", "gif");

        if (!in_array($media_file_type, $img_extensions_arr)) {
            return false;
        }

        //creation d'un nom unique pour la "PATH" du fichier
        $path = tempnam("../IMG", '');
        unlink($path);
        $file_name = basename($path, ".tmp");
        //creation de l'url pour la DB
        $url = $target_dir . $file_name . "." . $media_file_type;
        //deplacement du fichier uploader vers le bon repertoire (Medias)
        move_uploaded_file($profilePictureURL['tmp_name'], "../" . $url);

        //add user to DB
        $TDG = UserTDG::getInstance();
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT), $url);
        $TDG = null;
        return true;
    }
}
