function load_more_comment(idbalise) {
    commentCount = commentCount + 4;
    load_comment(idbalise, commentCount,id, type);
  };
  function load_comment(idbalise, commentCount, objectID, objectType) {
    if (idbalise.startsWith("Alb")) {
        $('#'+idbalise).load("HTML/commentViewAlbum.php" , {
            objectID : idbalise.substring(3),
            objectType : objectType,
            commentNewCount : commentCount
          });  
    } else {  
     
        $('#'+idbalise).load("HTML/commentView.php" , {
            objectID : objectID,
            objectType : objectType,
            commentNewCount : commentCount
          }, function() { console.log(objectType);}); 
    }
  }