<?php

include_once __DIR__ . "/likeTDG.php";

class Like{

    private $objectId;
    private $objectType;
    private $userId;

    public function __construct(){
       
    }
    //getters
    public function get_object_Id(){
        return $this->objectId;
    }

    public function get_object_type(){
        return $this->objectType;
    }

    public function get_user_Id(){
        return $this->userId;
    }
    //setters
    public function set_object_Id($objectId){
        $this->objectId = $objectId;
    }

    public function set_object_type($objectType){
        $this->objectType = $objectType;
    }

    public function set_userId($userId){
        $this->userId = $userId;
    }
    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function get_likes($objectId,$objectType){
        $TDG = LikeTDG::getInstance();
        return $TDG->count_likes($objectId,$objectType);
    }
}


