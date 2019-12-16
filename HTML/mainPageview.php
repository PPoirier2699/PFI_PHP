<script src="JS\loadFeedAlbums.js"></script>
<script src="JS\imageView.js"></script>
<script src='JS/delete.js'></script>
<h2>Main page content</h2>
<div id="feed">
<?php
    include_once "./CLASSES/ALBUM/album.php";
    include_once "./UTILS/sessionHandler.php";

    $album = new Album;
    
    $res = $album->get_top_album(4);
    $album->display_albums($res);

?>
</div>
<div class="container w-75 mt-5" style='float: left; position: relative;' id="albums">
    <button class="btn btn-light" style="position: absolute; left: 0;" id="moreAlbums">More albums</button>
</div>

