<script src="JS\loadFeedAlbums.js"></script>
<script src="JS\imageView.js"></script>
<script src="JS\add.js"></script>
<script src="JS\delete.js"></script>
<script src="JS\edit.js"></script>
<script src="JS\comment.js"></script>
<h2>Main page content</h2>
<div id="feed">
<?php
    include_once "./CLASSES/ALBUM/album.php";
    include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
    include_once __DIR__ . "/../CLASSES/LIKE/like.php";
    include_once __DIR__ . "/../CLASSES/USER/user.php";
    include_once __DIR__ . "/../UTILS/sessionHandler.php";
    $comment = new Comment;
    $album = new Album;
    
    $res = $album->get_top_album(4);
    $album->display_album($res);
 ?>
</div>