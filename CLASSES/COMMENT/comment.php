<?php

include_once __DIR__ . "/commentTDG.php";
include_once __DIR__ . "/../../UTILS/formValidator.php";

class Comment{

    private $id;
    private $objectType; // si le commentaire est sur une image ou un album
    private $creationTime;
    private $content;
    private $authorID;


    
    public function __construct(){
       
    }


    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_objectType(){
        return $this->objectType;
    }

    public function get_content(){
        return $this->content;
    }

    public function get_creationTime(){
        return $this->creationTime;
    }
    public function get_authorID(){
        return $this->authorID;
    }


    //setters
    public function set_id($id){
        $this->id = $id;
    }

    public function set_objectType($objType){
        $this->objectType = $objType;
    }
    public function set_authorID($aId){
        $this->authorID = $aId;
    }

    public function set_content($content){
        $this->content = $content;
    }

    public function set_creationTime($ct){
        $this->description = $ct;
    }


    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_comment($id){
        $TDG = CommentTDG::getInstance();
        $res = $TDG->get_by_id($id);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['id'];
        $this->objectType = $res['objectType'];
        $this->authorID = $res['authorID'];
        $this->content = $res['content'];
        $this->creationTime = $res['creationTime'];
        
        $TDG = null;
        return true;
    }
    public function add_comment($objectType, $objectID, $content, $authorID) {
        $date = date("Y-n-j g:i:s");;
        $objectType = Validator::($objectType);
        $objectID = Validator::sanitize($objectID);
        $content = Validator::sanitize($content);
        $authorID = Validator::sanitize($authorID);

        $TDG = CommentTDG::getInstance();
        $resp = $TDG->add_comment($objectType, $objectID, $date, $content, $authorID);

        $TDG = null;
        return $resp;
    }
    public function get_comment_by_id($id) {
        $TDG = CommentTDG::getInstance();
        $resp = $TDG->get_by_objectID($id);

        $TDG = null;
        return $resp;
    }
    public function edit_comment($id, $content) {
        $TDG = CommentTDG::getInstance();
        $resp = $TDG->edit_comment($id, $content);

        $TDG = null;
        return $resp;
    }
    public function delete_comment($id) {
        $TDG = CommentTDG::getInstance();
        $resp = $TDG->delete_comment($id);

        $TDG = null;
        return $resp;
    }
}


