function edit(idbalise, myId, objectType) {
    $('#'+idbalise).load("DOMAINLOGIC/edit.dom.php" , {
      objectID : myId,
      objectType : objectType,
      content : $('#newContent').val()
    }, function() {
      if (objectType == 'comment') {
        load_comment(idbalise, commentCount, id, type);
      } else if (objectType == 'image') {
        location.reload();
      } else if (objectType == 'album') {
        location.reload();
      }
        
    });   
  }
  
  function edit_button_click(balise, element, type) {
    if (!$('#newContent').length){
      $(element).after(`<textarea id="newContent"></textarea>`);
      $('#newContent').after("<button onclick='edit(`"+balise+"`,`" +element.value + "`, `" + type +"`);'>submit</button>");
    } 
  }