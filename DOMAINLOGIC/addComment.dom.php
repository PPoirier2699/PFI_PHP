<?php
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
    include_once __DIR__ . "/../UTILS/sessionHandler.php";

    session_start();
    $content = $_POST["content"];
    $objectID = $_POST["objectID"];
    $objectType = $_POST["objectType"];
    $authorID = $_SESSION["userID"];

    if(validate_session()) {
        if(!empty($content)) {
            $com = new Comment();
            $com->add_comment($objectType, $objectID, $content, $authorID);
        }     
    }
?>