<?php
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    session_start();

    $objectID = $_POST['objectID'];
    $objectType = $_POST['objectType'];
    $content = $_POST["content"];
 
    if($objectType == 'comment') {
        $comment = new Comment();
        $comment->edit_comment($objectID, $content);
    } else if ($objectType == 'image') {
        $image = new Image();
        $image->edit_image($objectID, $content);
    }
    else if ($objectType == 'album') {
        $album = new Album();
        $album->edit_desc($objectID, $content);
    }

?>