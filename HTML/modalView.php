<!-- The Modal -->


<div id="myModal" class="modal ">
  <div class="modal-content">  

  <div>
      <!-- Modal Content (The Image) -->

      
    <img class="modal-image" id="img01">

    <div id="commentForJS" class="commentParent overflow-auto"></div>
    <input type="text" name="objectType" id="objectType" value="image" style="display:none;">
    <input type="text" name="objectID" value="" id="imageIDPostComment" style="display:none;">

    <?php if(validate_session()) {?>
    <div class="commentParent">
      <div class="comment">
          <div style="float: left;font-weight: bold;"><?php echo $_SESSION["userName"] ?></div>
          <textarea id="contentComment" name="content" class="form-control" rows="2"></textarea>
          <button class="btn btn-primary" type="submit" id="addCommentButton" style="font-size:12;margin-top:0;margin-bottom:0; margin-left:30%; margin-right:30%; width:40%;">Add Comment</button>
          
      </div>
    </div>
    <?php } ?>
  </div>


  <!-- Modal Caption (Image Text) -->
  </div>  
  <!-- The Close Button -->
  <span class="close">&times;</span>
</div>
