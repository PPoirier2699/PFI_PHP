<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class CommentTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    public function __construct(){
        
        $this->tableName = "comments";
        parent::__construct();
    }
    public static function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new CommentTDG();  
        }
        return self::$_instance;
    }
    //create table
    public function createTable(){
        
        try{
            $conn = $this->connect();
            $query = "CREATE TABLE IF NOT EXISTS comments
            (id INTEGER(10) AUTO_INCREMENT PRIMARY KEY,
            objectType CHAR(5) NOT NULL,
            creationTime DATE NOT NULL,
            content LONGTEXT NOT NULL,
            authorID INTEGER(10) NOT NULL)";
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
            $query = "DROP TABLE comments";
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
    public function get_by_objectID($id){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, objectType, objectID, creationTime, content, authorID FROM $tableName WHERE objectID=:objectID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':objectID', $id);
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
    public function get_by_id($id){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, objectType, creationTime, content, authorID FROM $tableName WHERE id=:id";
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
    
    public function get_by_authorID($aID){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT id, objectType, creationTime, content, authorID FROM $tableName WHERE auhtorID=:aID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':aID', $aID);
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
    public function add_comment($objectType, $objectID, $creationTime, $content, $authorID){
        
        try{
            $conn = $this->connect();
            $query = "INSERT INTO comments (objectID, objectType, creationTime, content, authorID) VALUES (:objectID, :objectType, :creationTime, :content, :authorID)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':objectID', $objectID);
            $stmt->bindParam(':objectType', $objectType);
            $stmt->bindParam(':creationTime', $creationTime);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':authorID', $authorID);
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
}