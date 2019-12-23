<?php

include_once __DIR__ . "/../../UTILS/connector.php";

class AlbumTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    public function __construct(){
        
        $this->tableName = "albums";
        parent::__construct();
    }
    public static function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new AlbumTDG();  
        }
        return self::$_instance;
    }
    //create table
    public function createTable(){
        
        try{
            $conn = $this->connect();
            $query = "CREATE TABLE IF NOT EXISTS albums (id INTEGER(10) AUTO INCREMENT PRIMARY KEY,
            title VARCHAR(50) NOT NULL,
            authorID INTEGER(10) NOT NULL,
            description LONGTEXT NOT NULL,
            creationTime DATE NOT NULL)";
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
            $query = "DROP TABLE albums";
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
            $query = "SELECT id, title, authorID, description, creationTime FROM albums WHERE id=:id";
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
    public function get_by_title($title){
        
        try{
            $conn = $this->connect();
            $query = "SELECT id, title, authorID, description, creationTime FROM albums WHERE title=:title";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':title', $title);
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
            $query = "SELECT id, title, authorID, description, creationTime FROM albums WHERE auhtorID=:aID";
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
    public function add_album($title, $authorID, $descriptionAlbum, $creationTime,$newImage,$descriptionImage){
        
        try{
            $conn = $this->connect();
            $query = "INSERT INTO albums (title, authorID, description, creationTime) VALUES (:title, :authorID, :description, :creationTime)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':authorID', $authorID);
            $stmt->bindParam(':description', $descriptionAlbum);
            $stmt->bindParam(':creationTime', $creationTime);
            $stmt->execute();
            $resp = true;
        }
        catch(PDOException $e)
        {
            $resp =  false;
        }
        include_once __DIR__ . "/../IMAGE/image.php";
        if($resp){
            $image = new Image();
            $image->add_picture_to_album($newImage, $this->get_last_inserted_album_id(),$descriptionImage);
        }
        
           
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
    public function delete_album($id){
        // supprime l'album
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DELETE FROM $tableName WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp =  true;
        }
        catch(PDOException $e)
        {
            $resp =  false;
        }
        // supprime tous les images qui etait dans l'album
        try{
            $conn = $this->connect();
            $query = "DELETE FROM images WHERE albumID=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
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
    public function get_top_album($newAlbumCount){
        try{
            $conn = $this->connect();
            $query = "SELECT a.id, a.title, a.description, a.creationTime, i.url, u.username, u.id userID
            FROM albums a inner join images i on a.id=i.albumID inner join users u  group by a.id limit $newAlbumCount";
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
    public function search_album($searchWord,$newAlbumCount){
        
        try{
            $conn = $this->connect();
            $query = "SELECT a.id, a.title, a.description, a.creationTime, i.url
            FROM albums a inner join images i on a.id=i.albumID
            WHERE title like :title group by a.id limit $newAlbumCount";
            $stmt = $conn->prepare($query);
            $searchWord = '%'.$searchWord.'%';
            $stmt->bindParam(':title', $searchWord);
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
    public function search_all_albums($userID,$newAlbumCount){
        
        try{
            $conn = $this->connect();
            $query = "SELECT a.id, a.title, a.description, a.creationTime, i.url
            FROM albums a inner join images i on a.id=i.albumID inner join users u on u.id = a.authorID
            WHERE u.id = :user group by a.id limit $newAlbumCount";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':user', $userID);
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
    public function get_last_inserted_album_id(){
        try{
            $conn = $this->connect();
            $query = "SELECT max(id) id from albums";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $res = $stmt->fetch();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $res['id'];
    }
    public function edit_desc($id, $content){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName set description=:description where id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':description', $content);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $res = true;
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        //fermeture de connection PDO
        $conn = null;
        return $res['id'];
    }
}
