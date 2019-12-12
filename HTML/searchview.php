<script src="JS\loadSearchMedia.js"></script>
<script src="JS\imageView.js"></script>
<?php

include_once "./CLASSES/ALBUM/album.php";
include_once "./CLASSES/IMAGE/image.php";
include_once "./CLASSES/USER/user.php";


$album = new Album;
$img = new Image;
$user = new User;
$searchdWord = $_POST['search'];

$albumsRes = $album->search_album($searchdWord,3);
$imagesRes = $img->search_image($searchdWord,3);
$usersRes = $user->search_user($searchdWord,3);
?>
<input id="searchWord" style="display: none;" value="<?php echo $_POST['search']?>">
<h1>ALBUMS</h1><br><hr><br>
<div id="albums" class="p-4 border" style="position: relative;">
	<?php $album->display_album_search($albumsRes); ?>	
	<div id="message"></div>
</div><br>
<h1>IMAGES</h1><br><hr><br>
<div id="images" class="p-4 border" style="position: relative;">
	<?php $img->display_image_search($imagesRes); ?>
</div><br>
<h1>USERS</h1><br><hr><br>
<div id="users" class="p-4 border" style="position: relative;">
	<?php $user->display_user_search($usersRes); ?>
</div><br>


