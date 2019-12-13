var id;
var type;
var commentCount = 5;
$(document).ready(function(){
  // Get the image and insert it inside the modal - use its "alt" text as a caption$(document).ready(function(){
  var modal = document.getElementById("myModal");
  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var modalImg = $("#img01");
  $('.imageModal').click(function(){
      modal.style.display = "block";
      var newSrc = this.src;
      id = this.title;
      type = $('#objectType').val();
      modalImg.attr('title', id);
      $('#imageIDPostComment').attr('value', id);
      modalImg.attr('src', newSrc);      

      load_comment(commentCount, id, type);

      span.onclick = function() {
        modal.style.display = "none";
        commentCount = 5;
      }
  });
  $("#addCommentButton").click(function() {
    var content = $('#contentComment').val();
    $('#contentComment').val("");

    $("#commentForJS").load("DOMAINLOGIC/addComment.dom.php" , {
      objectID : id,
      objectType : type,
      content : content
    }, function() {load_comment(commentCount, id, type);}); 
    
  });

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on <span> (x), close the modal


  
});
function load_more_comment() {
  commentCount = commentCount + 4;
  load_comment(commentCount,id, type);
};
function load_comment(commentCount, id, type) {
  $("#commentForJS").load("HTML/commentView.php" , {
    objectID : id,
    objectType : type,
    commentNewCount : commentCount
  });  
}
function edit(myId, objectType) {
  $("#commentForJS").load("DOMAINLOGIC/edit.dom.php" , {
    objectID : myId,
    objectType : objectType,
    content : $('#newContent').val()
  }, function() {
    if (objectType == 'comment') {
      load_comment(commentCount, id, type);
    } else if (objectType == 'image') {
      location.reload();
    }
      
  });   
}
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
function edit_button_click(element, type) {
  if (!$('#newContent').length){
    $(element).after(`<textarea id="newContent"></textarea>`);
    $('#newContent').after(`<button onclick="edit('${element.value}', '${type}');">submit</button>`);
  } 
}