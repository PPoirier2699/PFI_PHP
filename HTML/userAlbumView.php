<script src="JS\loadUserAlbum.js"></script>
<script src="JS\imageView.js"></script>
<?php

include_once "./CLASSES/ALBUM/album.php";


$album = new Album;

$userID = $_GET['userID'];

$albumsRes = $album->search_all_albums($userID,3);

?>
<input id="userID" style="display: none;" value="<?php echo $userID ?>"></input>
<h1>ALBUMS</h1><br><hr><br>
<div id="albums" class="p-4 border" style="position: relative;">
    <?php $album->display_album_search($albumsRes); ?>	
</div><br>



