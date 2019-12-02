<h2>Main page content</h2>

<?php
    include_once "./CLASSES/ALBUM/albumTDG.php";

    $albumTDG = AlbumTDG::getInstance();
    
    $res = $albumTDG->get_top_album(4);
    $albumTDG->display_albums($res);

?>

