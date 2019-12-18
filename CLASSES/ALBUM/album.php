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
   public function display_album($res) {

        $nb = 4;
        if(!empty($res)){      
            foreach($res as $info){
                echo "<div class='container border w-75 p-3 mt-5' style='float: left'>";
                echo "<p><a style='text-decoration: none; color: black; font-size: 20px;' href='#'>" . $info['username'] . "</a></p>";
                echo "<p><a style='text-decoration: none; color: black; font-size: 20px;' href='imageList.php?albumID=".$info['id']."'>".$info['title']."</a></p>";
                echo "<img src='". $info['url']."' alt='img' height='100'>";
                echo "<p class='lead'>Description: ". $info['description'] ."</p>";
                echo "<p class='lead'>". $info['creationTime'] ."</p>";
    
                if(validate_session() && $info["username"] == $_SESSION["userName"]) {	
                    echo "<button value='". $info['id'] ."' onClick='edit_button_click(`Alb".$info['id']."`,this, `album`);' type='button' class='btn'><u>Edit</u> </button>";
                    echo "<button onClick='deleteFunc(`Alb". $info['id']. "`," .$info['id'] . ", `album`);' type='button' class='btn'>Delete</button>";
                }
                
                echo "<div id='Alb". $info['id'] ."'></div>";
                
                echo "<div style='width:100%; margin:0;' class='commentParent'>";
    
                    echo "<script>load_comment(`Alb". $info['id'] ."`, ". $nb .",`". $info['id']."`,`album`);</script>";
    
                echo "<button class='btn btn-primary' onClick='load_more_comment(`Alb". $info['id'] ."`)'>More Comment</button>";
                    
                    if(validate_session()) {               
                    echo "<div class='comment'>";
                        echo "<div style='float: left;font-weight: bold;'>". $_SESSION["userName"] ."</div>";
                        echo "<textarea id='Alb". $info['id'] ."Txt' name='content' class='form-control' rows='2'></textarea>";
                        echo "<button onClick='add_comment(`Alb". $info['id'] ."`," .$info['id'] .", `album`);' class='btn btn-primary' style='font-size:12;margin-top:0;margin-bottom:0; margin-left:30%; margin-right:30%; width:40%;'>Add Comment</button>";
                    echo "</div>";
                    }

                echo "</div>";
                echo "</div>";
            }                                 
        }   
    echo "</div>";
    echo "<div class='container w-75 mt-5' style='float: left; position: relative;'>";
        echo "<button class='btn btn-light' style='position: absolute; left: 0;' id='moreAlbums'>More albums</button>";
    echo "</div>";
    
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
    public function search_all_albums($userName){
        $TDG = AlbumTDG::getInstance();
        return $TDG->search_all_albums($userName);
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
    public function edit_desc($id, $content) {
        $TDG = AlbumTDG::getInstance();
        $res = $TDG->edit_desc($id, $content);

        if(!$res)
        {
            $TDG = null;
            return false;
        }
        $TDG = null;
        return $res;
    }
}


