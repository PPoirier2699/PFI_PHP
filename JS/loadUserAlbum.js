$(document).ready(function(){
    var albumCount = 3;
    var userID = $("#userID").val();
    $("#moreAlbums").click(function(){
        albumCount = albumCount + 3;
        $("#albums").load("DOMAINLOGIC/loadUserAlbum.php" , {
            albumNewCount: albumCount,
            userID: userID
        });
    });
});