function deleteFunc(myId, objectType) {
    $("#commentForJS").load("DOMAINLOGIC/delete.dom.php" , {
      objectID : myId,
      objectType : objectType
    }, function() {
      if (objectType == 'comment') {
        load_comment(commentCount, id, type);
      } else if (objectType == 'image') {
        location.reload();
      } else if (objectType == 'album') {
        location.reload();
      }
        
    });   
  }