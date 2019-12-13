<?php
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    session_start();

    $objectID = $_POST['objectID'];
    $objectType = $_POST['objectType'];
 
    if($objectType == 'comment') {
        $comment = new Comment();
        $comment->delete_comment($objectID);
    } else if ($objectType == 'image') {
        $image = new Image();
        $image->delete_image($objectID);
    } else if ($objectType == 'album') {
        $album = new Album();
        $album->delete_album($objectID);
    }

?>