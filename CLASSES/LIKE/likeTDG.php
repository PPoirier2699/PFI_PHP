<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class LikeTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    public function __construct(){
        
        $this->tableName = "likes";
        parent::__construct();
    }
    public static function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new LikeTDG();  
        }
        return self::$_instance;
    }

    //create table
    public function createTable(){
        
        try{
            $conn = $this->connect();
            $query = "CREATE TABLE IF NOT EXISTS likes
            (objectID INTEGER(10),
            objectType CHAR(5) NOT NULL,
            userID INTEGER(10) NOT NULL)";
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
            $tableName = $this->tableName;
            $query = "DROP TABLE $tableName";
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


    public function count_likes($objectId,$objectType){
        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT Count(userID) number from $tableName WHERE objectID=:objectID and objectType=:objectType";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':objectID', $objectId);
            $stmt->bindParam(':objectType', $objectType);
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
        return $result['number'];
    }
}
