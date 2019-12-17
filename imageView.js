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
      type = $('#addComment').val();
      id = this.title;
      $('#addComment').attr('value',this.title);
      modalImg.attr('title', id);
      $('#imageIDPostComment').attr('value', id);
      modalImg.attr('src', newSrc);      
      
      load_comment('commentForJS', commentCount, id, type);

      span.onclick = function() {
        modal.style.display = "none";
        commentCount = 5;
      }
  });

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on <span> (x), close the modal


  
});


