<?php

include_once __DIR__ . "/imageTDG.php";
include_once __DIR__ . "/../../UTILS/imageHandler.php";

class Image{

    private $id;
    private $url;
    private $albumID;
    private $description;
    private $creationTime;

   
    public function __construct(){
       
    }

    //permet de creer une copie dune image a partir d'un array
    private function makeImage($array) {
        $this->id = $array["id"];
        $this->url = $array["url"];
        $this->albumID = $array["albumID"];
        $this->description = $array["description"];
        $this->creationTime = $array["creationTime"];
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
        $TDG = ImageTDG::getInstance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->url = $res['url'];
        $this->albumID = $res['albumID'];
        $this->description = $res['description'];
        $this->creationTime = $res['creationTime'];
        
        $TDG = null;
        return true;
    }
    public function get_all_image_by_album($id) {
        $TDG = ImageTDG::getInstance();
        $res = $TDG->get_by_albumID($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }
        $TDG = null;
        return $res;
    }
    public function add_picture_to_album($image, $albumID, $desc) {
        $date = date("Y-n-j");

        $url = ImageHandler::FileToImageURL($image);

        $TDG = ImageTDG::getInstance();
        $resp = $TDG->add_image($url, $albumID, $desc, $date);

        $TDG = null;
        return $resp;
    }
 
}


