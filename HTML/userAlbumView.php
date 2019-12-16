<script src="JS\loadSearchMedia.js"></script>
<script src="JS\imageView.js"></script>
<?php

include_once "./CLASSES/ALBUM/album.php";


$album = new Album;

$user = $_GET['user'];

$albumsRes = $album->search_all_albums($user);

?>
<h1>ALBUMS</h1><br><hr><br>
<div id="albums" class="p-4 border" style="position: relative;">
    <?php $album->display_album_search($albumsRes); ?>	
</div><br>



