<script src="JS\loadFeedAlbums.js"></script>
<h2>Main page content</h2>
<div id="albums">
<?php
    include_once "./CLASSES/ALBUM/albumTDG.php";

    $albumTDG = AlbumTDG::getInstance();
    
    $res = $albumTDG->get_top_album(4);
    $albumTDG->display_albums($res);

?>
</div>
<div class="container w-75 mt-5" style='float: left; position: relative;'>
    <button class="btn btn-light" style="position: absolute; left: 0;" id="moreAlbums">More albums</button>
</div>

