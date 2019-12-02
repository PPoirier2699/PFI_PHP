<?php
  $alb = AlbumTDG::getInstance();
  $img = ImageTDG::getInstance();
  $user = UserTDG::getInstance();
  $searchedWord = $_GET['search'];

  $albums = $alb->search_album($searchedWord);
  $images = $img->search_image($searchedWord);
  $users = $user->search_user($searchedWord);
?>

<div class="container" style="margin-top:30px">
<h1>ALBUMS</h1>
  <?php 
    for($i = 0; i != $albums->count(); $i++)
    {
        echo $albums[$i]['id'];
    }
  ?>
<h1>IMAGES</h1>
  <?php 
    
  ?>
<h1>USERS</h1>
  <?php 
    
  ?>
</div>
