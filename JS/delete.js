function deleteFunc(idbalise, objectID, objectType) {
    $('#'+idbalise).load("DOMAINLOGIC/delete.dom.php" , {
      objectID : objectID,
      objectType : objectType
    }, function() {
      if (objectType == 'comment') {
        load_comment(idbalise, 4, idbalise.substring(3), objectType);
      } else if (objectType == 'image') {
        location.reload();
      } else if (objectType == 'album') {
        location.reload();
      }
        
    });   
  }