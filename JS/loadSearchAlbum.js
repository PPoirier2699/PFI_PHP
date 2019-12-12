$(document).ready(function(){
    var albumCount = 3
    var searchWord = $("#searchWord").val();
    $("#moreAlbums").click(function(){
        albumCount = albumCount + 4;
        $("#albums").load("DOMAINLOGIC/loadSearchAlbums.php" , {
            albumNewCount: albumCount,
            searchWord: searchWord
        });
    });
}); 