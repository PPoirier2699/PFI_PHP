
function add_comment(idbalise, objectID, objectType) {
    $('#'+ idbalise).load("DOMAINLOGIC/addComment.dom.php" , {
      objectID : objectID,
      objectType : objectType,
      content :  $('#' + idbalise + 'Txt').val()
    }, function() {
        $('#' + idbalise + 'Txt').val("");
        load_comment(idbalise, commentCount, objectID, objectType);}); 
  }

  