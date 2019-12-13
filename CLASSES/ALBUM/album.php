<?php

include_once __DIR__ . "/albumTDG.php";

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
    public function no_more_albums_to_display($albumNewCount,$res){
        if($albumNewCount > count($res)){
            echo "<h6 style='position: absolute; bottom: 5%;'>No more albums</h6>";
            echo"<script>$('#moreAlbums').remove();</script>";
        }
    }
    public function search_album($like,$newAlbumCount){
        $TDG = AlbumTDG::getInstance();
        return $TDG->search_album($like,$newAlbumCount);
    }
}


