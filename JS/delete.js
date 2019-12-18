function deleteFunc(idbalise, objectID, objectType) {
    $('#'+idbalise).load("DOMAINLOGIC/delete.dom.php" , {
      objectID : objectID,
      objectType : objectType
    }, function() {
      if (objectType == 'comment') {
        if (idbalise.startsWith('Alb')) {
          id = objectID;
          commentCount = 4;
          type = objectType;
        }
        console.log(idbalise);
        console.log(id);
        console.log(type);
        
        load_comment(idbalise, commentCount, id, type);
      } else if (objectType == 'image') {
        location.reload();
      } else if (objectType == 'album') {
        location.reload();
      }
        
    });   
  }