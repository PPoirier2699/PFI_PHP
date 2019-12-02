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
    public function add_album($title, $authorID, $description, $creationTime){
        
        try{
            $conn = $this->connect();
            $query = "INSERT INTO albums (title, authorID, description, creationTime) VALUES (:title, :authorID, :description, :creationTime)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':authorID', $authorID);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':creationTime', $creationTime);
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
            $query = "SELECT a.id, a.title, a.description, a.creationTime, i.url
            FROM albums a inner join images i on a.id=i.albumID limit $newAlbumCount";
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
    public function display_albums($res){
        if(!empty($res)){      
            foreach($res as $info){
                echo "<div class='container border w-75 p-3 mt-5' style='float: left'>";
                echo "<p><a style='text-decoration: none; color: black; font-size: 20px;' href='DOMAINLOGIC/imageList.dom.php?albumID=" . $info['id'] . "'>" . $info['title'] . "</a></p>";
                echo "<img src='" . $info['url']. "' alt='img' height='100'>";
                echo "<p class='lead'>Description: " . $info['description'] . "</p>";
                echo "<p class='lead'>" . $info['creationTime'] . "</p>";
                echo "</div>";   
            }                                 
        }      
    }
    public function display_Message($albumNewCount,$res){
        if($albumNewCount > count($res)){
            echo "<div class='container w-75 p-3 mt-5' style='position: relative;float: left'><h6 style='position: absolute; left: 0;'>No more albums</h6></div>";
            echo"<script>$('#moreAlbums').remove();</script>";
        }
    }
    public function search_album($like,$newAlbumCount){
        
        try{
            $conn = $this->connect();
            $query = "SELECT a.id, a.title, a.description, a.creationTime, i.url
            FROM albums a inner join images i on a.id=i.albumID
            WHERE title like :title limit $newAlbumCount";
            $stmt = $conn->prepare($query);
            $like = '%'.$like.'%';
            $stmt->bindParam(':title', $like);
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
    public function display_album_search($res){
        if(empty($res)){
            echo "<h4>No albums corresponding to the research!</h4>";
        }
        else{
            foreach($res as $results){
                echo "<h5 class='d-inline'><a style='text-decoration: none; color: black' href='HTML/imageListView.php?albumID=" . $results['id'] . "'>" . $results['title'] . "</a></h5>";
                echo "<button href='HTML/imageListView.php?albumID='" . $results['id'] ."' class='btn btn-primary'style='float: right'>View album</button>";         
                echo "<p class='lead'>" . $results['description'] . "</p>";
                echo "<p class='lead'>" . $results['creationTime'] . "</p>";
                echo "<br>";
            }
        }
    }
}
