<?php

include_once __DIR__ . "/../../UTILS/connector.php";
include_once __DIR__ . "/../../UTILS/imageHandler.php";

class UserTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    public function __construct(){
        
        $this->tableName = "users";
        parent::__construct();
    }
    public static function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new UserTDG();  
        }
        return self::$_instance;
    }

    //create table
    public function createTable(){
        
        try{
            $conn = $this->connect();
            $query = "CREATE TABLE IF NOT EXISTS users (id INTEGER(10) AUTO INCREMENT PRIMARY KEY,
            email VARCHAR(25) UNIQUE NOT NULL,
            username VARCHAR(25) NOT NULL,
            password VARCHAR(250) NOT NULL,
            profilePictureURL LONGTEXT NOT NULL)";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $resp = true;
        }

        //error catch and msg display
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }


    //drop table
    public function drop_table(){
        
        try{
            $conn = $this->connect();
            $query = "DROP TABLE users";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $resp = true;
        }

        //error catch and msg display
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }


    public function get_by_id($id){
        
        try{
            $conn = $this->connect();
            $query = "SELECT id, email, username, profilePictureURL FROM users WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }
        
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }


    public function get_by_email($email){
        
        try{
            $conn = $this->connect();
            $query = "SELECT * FROM users WHERE email=:email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }
        
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }


    public function get_by_username($username){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE username=:username";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }
        
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }


    public function get_all_users(){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, email, username, profilePictureURL FROM $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }
        
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }


    public function add_user($email, $username, $password, $profilePictureURL){
        $this->existing_infos($email,$username);
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (email, username, password, profilePictureURL) VALUES (:email, :username, :password, :profilePictureURL)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':profilePictureURL', $profilePictureURL);
            $stmt->execute();
            $resp =  true;
        }
        
        catch(PDOException $e)
        {
            $resp =  false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }


    /*
      update juste pour les infos non sensibles  
    */
    public function update_info($email, $username, $id){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET email=:email, username=:username WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }
    
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    

    /*
      update juste pour le password  
    */
    public function update_password($pw, $id){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET password=:password WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':password', $pw);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }
        
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function update_picture($email, $url) {
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET profilePictureURL=:profilePictureURL WHERE email=:email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':profilePictureURL', $url);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $resp = true;
        }        
        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function existing_infos($email,$username){
        if(!empty($this->get_by_email($email))){
            header("Location: ../register.php?ErrorMSG=Email%20already%20register!");
            die();
        }
        if(!empty($this->get_by_username($username))){
            header("Location: ../register.php?ErrorMSG=Username%20already%20taken!");
            die();
        }
    }
    public function search_user($searchWord){
        
        try{
            $conn = $this->connect();
            $query = "SELECT id, email, username, profilePictureURL FROM users WHERE username like :searchWord";
            $stmt = $conn->prepare($query);
            $searchWord = '%'.$searchWord.'%';
            $stmt->bindParam(':searchWord', $searchWord);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $result;
    }

}
