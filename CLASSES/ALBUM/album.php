<?php

include_once __DIR__ . "/albumTDG.php";
include_once __DIR__ . "/../../UTILS/sessionHandler.php";

class Album{

    private $id;
    private $title;
    private $authorID;
    private $description;
    private $creationTime;

    
    public function __construct(){
       
    }


    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_title(){
        return $this->title;
    }

    public function get_authorID (){
        return $this->authorID;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_creationTime(){
        return $this->creationTime;
    }


    //setters
    public function set_id($id){
        $this->id = $id;
    }

    public function set_title($title){
        $this->title = $title;
    }

    public function set_authorID($aID){
        $this->authorID = $aID;
    }

    public function set_description($desc){
        $this->description = $desc;
    }

    public function set_creationTime($ct){
        $this->description = $ct;
    }


    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_album($id){
        $TDG = AlbumTDG::getInstance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->title = $res['title'];
        $this->authorID = $res['authorID'];
        $this->description = $res['description'];
        $this->creationTime = $res['creationTime'];
        
        $TDG = null;
        return true;
    }

    public function get_album($id) {
        $TDG = AlbumTDG::getInstance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }
        $TDG = null;
        return $res;
    }
    public function get_top_album($newAlbumCount){
        
        $TDG = AlbumTDG::getInstance();
        return $TDG->get_top_album($newAlbumCount);
    }
    public function display_albums($res){
        if(!empty($res)){      
            foreach($res as $info){ 
                echo "<div id='commentForJS' class='container border w-75 p-3 mt-5' style='float: left'>";
                echo "<p><a style='text-decoration: none; color: black; font-size: 20px;' href='myProfile.php?userID=" . $info['userID'] . " '> " . $info['username'] ." </a></p>";
                echo "<p><a style='text-decoration: none; color: black; font-size: 20px;' href='imageList.php?albumID=" . $info['id'] . "'>" .$info['title'] . "</a></p>";
                echo "<img src=' " . $info['url'] . "'  alt='img' height='100'>";
                echo "<p class='lead'>Description: " . $info['description'] . "</p>";
                echo "<p class='lead'> " . $info['creationTime'] . "</p>";
                if(validate_session() && $info["username"] == $_SESSION["userName"]) {			      
                    echo "<button onClick='deleteFunc(" . $info['id'] . ", `album`);' type='button' class='btn'>Delete</button>";
                } 
                 echo "</div>";
            }                                 
        }   
    }
    public function no_more_albums_to_display($albumNewCount,$res){
        if($albumNewCount > count($res)){
            echo"<script>$('#moreAlbums').remove();
            $('#albums').append(`<h6 style=position: absolute; bottom: 0; float: left;'>No more albums</h6>`);</script>";
        }
    }
    public function display_album_search($res){
        if(empty($res)){ 
            echo "<h4>No albums corresponding to the research!</h4>";
        }
        else{            
            foreach($res as $results){
                echo "<h5 class='d-inline'><a style='text-decoration: none; color: black' href='imageList.php?albumID=" . $results['id'] ."'> " . $results['title'] . "</a></h5>";
                echo "<a class='btn btn-primary' style='float: right' href='imageList.php?albumID=" . $results['id'] . " '>View album</a>";       
                echo "<p class='lead'>" . $results['description'] . "</p>";
                echo "<p class='lead'>" . $results['creationTime'] . "</p><br>";
                echo "<br><button class='btn btn-light' style='position: absolute; left: 2%; bottom: 5%;' id='moreAlbums'>More albums</button>";
            }
        } 
    }
    public function search_album($like,$newAlbumCount){
        $TDG = AlbumTDG::getInstance();
        return $TDG->search_album($like,$newAlbumCount);
    }
    public function delete_album($id) {
        $TDG = AlbumTDG::getInstance();
        $res = $TDG->delete_album($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }
        $TDG = null;
        return $res;
    }
}


