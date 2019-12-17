function load_more_comment(idbalise) {
    commentCount = commentCount + 4;
    load_comment(idbalise, commentCount,id, type);
  };
  function load_comment(idbalise, commentCount, objectID, objectType) {
    if (idbalise.startsWith("Alb")) {
        console.log(idbalise);
        $('#'+idbalise).load("HTML/commentViewAlbum.php" , {
            objectID : objectID,
            objectType : objectType,
            commentNewCount : commentCount
          });  
    } else {  
        $('#'+idbalise).load("HTML/commentView.php" , {
            objectID : objectID,
            objectType : objectType,
            commentNewCount : commentCount
          }); 
    }
  }