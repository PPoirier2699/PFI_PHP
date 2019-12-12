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


   public function register($email, $username, $pw, $vpw, $profilePicture)
    {
        $url = ImageHandler::FileToImageURL($profilePicture);
        //check is both password are equals
        if (!($pw === $vpw) || empty($pw) || empty($vpw)) {
            header("Location: ../register.php?ErrorMSG=Password%20and%20password%20aren't%20the%20same!");
            die();
        }

        
        //add user to DB
        $TDG = UserTDG::getInstance();
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT), $url);
        $TDG = null;
        return true;
    }
    public function validate_email_not_exists($email){
        $TDG = new UserTDG();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if($res)
        {
            return false;
        }
        return true;
    }
    public function update_user_info($email, $newmail, $newname){
        //load user infos
        if(!$this->load_user($email)) {
          return false;
        }        
        if(empty($this->id) || empty($newmail) || empty($newname)){
          return false;
        }
        //check if email is already used
        if(!$this->validate_email_not_exists($newmail) && $email != $newmail)
        {
            return false;
        }        


        $this->email = $newmail;
        $this->username = $newname;

        $TDG = new UserTDG();
        $res = $TDG->update_info($this->email, $this->username, $this->id);
        if($res){
          $_SESSION["userName"] = $this->username;
          $_SESSION["userEmail"] = $this->email;
        }
        $TDG = null;
        return $res;
    }
    /*
      @var: current $email, oldpw, new pw, newpw validation
    */
    public function update_user_pw($email, $oldpw, $pw, $pwv){
        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }
        //check if passed param are valids
        if(empty($pw) || $pw != $pwv){
          return false;
        }
        //verify password
        if(!password_verify($oldpw, $this->password))
        {
            return false;
        }
        //create TDG and update to new hash
        $TDG = new UserTDG();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->id);
        $this->password = $NHP;
        $TDG = null;
        //only return true if update_user_pw returned true
        return $res;
    }
    
    public function update_user_picture($email, $file) {
        $url = ImageHandler::FileToImageURL($file);


        $this->profilePictureURL = $url;

        $TDG = new UserTDG();
        $res = $TDG->update_picture($email, $url);
        if($res) {
            $_SESSION["profilePicPath"] = $this->profilePictureURL;
        }
        $TDG = null;
        return $res;
    }
    public function get_user_by_id($id){
        $TDG = new UserTDG;
        return $TDG->get_by_id($id);
    }
    public function search_user($searchdWord){
        $TDG = UserTDG::getInstance();
        return $TDG->search_user($searchdWord);
    }
    public function display_user_search($res){
        if(empty($res)){
            echo "<h4>No users corresponding to the research!</h4>";
        }
        else{            
            foreach($res as $results){
                echo "<h5 class='d-inline'><a style='text-decoration: none; color: black' href='#'>" . $results['username'] . "</a></h5>";
                echo "<a class='btn btn-primary' style='float: right' href='#'>View user profile</a>";         
                echo "<img src='" .$results['profilePictureURL'] ."'height='100' class='border p-3 m-3'>";
                echo "<br>";
            }
            echo "<br><button class='btn btn-light' style='position: absolute; left: 2%; bottom: 5%;' id='moreUsers'>More users</button>";
        }
    }
}
