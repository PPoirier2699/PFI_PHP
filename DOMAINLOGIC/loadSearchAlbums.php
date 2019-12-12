<?php
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    $albumNewCount = $_POST['albumNewCount'];
    $searchdWord = $_POST['searchWord'];

    $album = new Album;
    $albumsRes = $album->search_album($searchdWord,$albumNewCount);
    $album->display_album_search($albumsRes);
    $album->no_more_albums_to_display($albumNewCount,$albumsRes); 
?>