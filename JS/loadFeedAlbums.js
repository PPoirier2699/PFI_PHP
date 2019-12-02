$(document).ready(function(){
    var albumCount = 4
    $("#moreAlbums").click(function(){
        albumCount = albumCount + 4;
        $("#albums").load("DOMAINLOGIC/loadFeedAlbums.php" , {
            albumNewCount: albumCount
        });
    });
});