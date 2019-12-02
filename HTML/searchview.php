<?php
  include_once "./CLASSES/ALBUM/albumTDG.php";
  include_once "./CLASSES/IMAGE/imageTDG.php";
  include_once "./CLASSES/USER/userTDG.php";

    
  $albumTDG = AlbumTDG::getInstance();
  $imgTDG = ImageTDG::getInstance();
  $userTDG = UserTDG::getInstance();
  $searchdWord = $_POST['search'];

  $albums = $albumTDG->search_album($searchdWord,4);
  $images = $imgTDG->search_image($searchdWord);
  $users = $userTDG->search_user($searchdWord);

  echo "<h1>ALBUMS</h1><br><hr>";
  $albumTDG->display_album_search($albums);
  echo"<h1>IMAGES</h1>";
  echo"<h1>USERS</h1>";
?>
