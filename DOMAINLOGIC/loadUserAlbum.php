<?php

    include_once  __DIR__ . "../../CLASSES/ALBUM/album.php";

    $userID = $_POST['userID'];
    $albumNewCount = $_POST['albumNewCount'];
    $album = new Album;
    $albumsRes = $album->search_all_albums($userID,$albumNewCount);
    $album->display_album_search($albumsRes);
    $album->no_more_albums_to_display($albumNewCount,$albumsRes); 

?>