$(document).ready(function(){
    var albumCount = 4
    $("#moreAlbums").click(function(){
        albumCount = albumCount + 4;
        $("#feed").load("DOMAINLOGIC/loadFeedAlbums.php" , {
            albumNewCount: albumCount
        });
    });
});