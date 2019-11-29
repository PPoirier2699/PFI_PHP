<?php

include_once __DIR__ . "/imageTDG.PHP";

class Image{

    private $id;
    private $url;
    private $albumID;
    private $description;
    private $creationTime;

   
    public function __construct(){
       
    }


    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_url(){
        return $this->url;
    }

    public function get_albumID(){
        return $this->albumID;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_creationTime(){
        return $this->creationTime;
    }


    //setters
    public function set_ID($id){
        $this->id = $id;
    }

    public function set_url($url){
        $this->url = $url;
    }

    public function set_albumID($albumId){
        $this->albumID = $albumId;
    }

    public function set_description($desc){
        $this->description = $desc;
    }

    public function set_creationTime($creaTime){
        $this->creationTime = $creaTime;
    }


    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_image($id){
        $TDG = new ImageTDG();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->email = $res['url'];
        $this->username = $res['albumID'];
        $this->password = $res['description'];
        $this->profilPicture = $res['creationTime'];
        
        $TDG = null;
        return true;
    }
 
}


