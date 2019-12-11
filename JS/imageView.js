$(document).ready(function(){
  // Get the image and insert it inside the modal - use its "alt" text as a caption$(document).ready(function(){
  var modal = document.getElementById("myModal");

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  var modalImg = $("#img01");
  $('.imageModal').click(function(){
      modal.style.display = "block";
      var newSrc = this.src;
      var id = this.title;
      var type = $('#objectType').val();
      modalImg.attr('title', id);
      $('#imageIDPostComment').attr('value', id);
      modalImg.attr('src', newSrc);

      $("#commentForJS").load("HTML/commentView.php" , {
        objectID : id,
        objectType : type
      });
      $()
      $("#addCommentButton").click(function() {
        var content = $('#contentComment').val();
        $('#contentComment').val("");

        $("#commentForJS").load("DOMAINLOGIC/addComment.dom.php" , {
          objectID : id,
          objectType : type,
          content : content
        });
        $("#commentForJS").load("HTML/commentView.php" , {
          objectID : id,
          objectType : type
        });
      });
  });
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }
});
  