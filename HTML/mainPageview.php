<script src="JS\loadFeedAlbums.js"></script>
<h2>Main page content</h2>
<div id="albums">
<?php
    include_once "./CLASSES/ALBUM/album.php";

    $album = new Album;
    
    $res = $album->get_top_album(4);
    if(!empty($res)){      
        foreach($res as $info){ ?>
            <div class='container border w-75 p-3 mt-5' style='float: left'>
            <p><a style='text-decoration: none; color: black; font-size: 20px;' href='#'><?php echo $info['username'] ?></a></p>
            <p><a style='text-decoration: none; color: black; font-size: 20px;' href='imageList.php?albumID=<?php echo $info['id'] ?>'><?php echo $info['title'] ?></a></p>
            <img src='<?php echo $info['url'] ?>' alt='img' height='100'>
            <p class='lead'>Description: <?php echo $info['description'] ?></p>
            <p class='lead'> <?php $info['creationTime'] ?></p>
            </div>
        <?php }                                 
    }   

?>
</div>
<div class="container w-75 mt-5" style='float: left; position: relative;'>
    <button class="btn btn-light" style="position: absolute; left: 0;" id="moreAlbums">More albums</button>
</div>

