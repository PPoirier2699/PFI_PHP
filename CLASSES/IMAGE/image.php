<?php

include_once __DIR__ . "/imageTDG.php";
include_once __DIR__ . "/../../UTILS/imageHandler.php";
include_once __DIR__ . "/../../UTILS/formValidator.php";

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
        $albumID = Validator::sanitize($albumID);
        $desc = Validator::sanitize($desc);
        $url = ImageHandler::FileToImageURL($image);

        $TDG = ImageTDG::getInstance();
        $resp = $TDG->add_image($url, $albumID, $desc, $date);

        $TDG = null;
        return $resp;
    }
    public function search_image($searchWord,$imageCount){
        $TDG = ImageTDG::getInstance();
        return $TDG->search_image($searchWord,$imageCount);
    }
    public function display_image_search($res){
        if(empty($res)){
            echo "<h4>No images corresponding to the research!</h4>";
        }
        else{            
            foreach($res as $results){
                echo "<h5 class='d-inline'><a style='text-decoration: none; color: black' href='#'>Author: " . $results['username'] . "</a></h5><br>";
                echo "<img src='" .$results['url'] ."'height='200' class='mt-3 mb-3 imageModal'>";
                echo "<a class='btn btn-primary' style='float: right' href='imageList?albumID=" . $results['albumID'] ."'>View full album</a>";         
                echo "<p class='lead'>" . $results['description'] . "</p>";
                echo "<p class='lead'>Album: " . $results['title'] . "</p>";
                echo "<p class='lead'>" . $results['creationTime'] . "</p>";
                echo "<br>";
            }
            echo "<br><button class='btn btn-light' style='position: absolute; left: 2%; bottom: 2%;' id='moreImages'>More images</button>";
        }
    }
    public function no_more_images_to_display($imageNewCount,$res){
        if($imageNewCount > count($res)){
            echo "<h6 style='position: absolute; left: 2%; bottom: 2%'>No more images</h6>";
            echo"<script>$('#moreImages').remove();</script>";
        }
    }
    public function edit_image($id, $description) {
        $description = Validator::sanitize($description);
        $TDG = ImageTDG::getInstance();
        $resp = $TDG->edit_image($id, $description);

        $TDG = null;
        return $resp;
    }
    public function delete_image($id) {
        $TDG = ImageTDG::getInstance();
        $resp = $TDG->delete_image($id);

        $TDG = null;
        return $resp;
    }
}


