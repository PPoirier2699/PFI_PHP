<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/albumTDG.php";

    $albumNewCount = $_POST['albumNewCount'];
    
    $albumTDG = AlbumTDG::getInstance();
    $res = $albumTDG->get_top_album($albumNewCount);
    $albumTDG->display_albums($res);
  
    $albumTDG->display_Message($albumNewCount,$res); 

?>