$(document).ready(function(){
    var albumCount = imageCount = userCount = 3;
    var searchWord = $("#searchWord").val();
    $("#moreAlbums").click(function(){
        albumCount = albumCount + 3;
        $("#albums").load("DOMAINLOGIC/loadSearchAlbums.php" , {
            albumNewCount: albumCount,
            searchWord: searchWord
        });
    });
    $("#moreImages").click(function(){
        imageCount = imageCount + 3;
        $("#images").load("DOMAINLOGIC/loadSearchImages.php" , {
            imageNewCount: imageCount,
            searchWord: searchWord
        });
    });
    $("#moreUsers").click(function(){
        userCount = userCount + 3;
        $("#users").load("DOMAINLOGIC/loadSearchUsers.php" , {
            userNewCount: userCount,
            searchWord: searchWord
        });
    });
}); 