<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    $albumNewCount = $_POST['albumNewCount'];
    
    $album = new Album;
    $res = $album->get_top_album($albumNewCount);
    $album->display_albums($res);
    $album->no_more_albums_to_display($albumNewCount,$res); 
?>