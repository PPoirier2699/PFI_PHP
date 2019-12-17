<!-- The Modal -->


<div id="myModal" class="modal ">
  <div class="modal-content">  

  <div>
      <!-- Modal Content (The Image) -->

      
    <img class="modal-image" id="img01">

    <div id="commentForJS" class="commentParent overflow-auto"></div>
    <div class="commentParent">
    
    
    <?php if(validate_session()) {?>
    
      <div class="comment">
          <div style="float: left;font-weight: bold;"><?php echo $_SESSION["userName"] ?></div>
          <textarea id="commentForJSTxt" name="content" class="form-control" rows="2"></textarea>
          <button id="addComment" value="image" onClick="add_comment('commentForJS', this.value, 'image');" class="btn btn-primary" style="font-size:12;margin-top:0;margin-bottom:0; margin-left:30%; margin-right:30%; width:40%;">Add Comment</button>
          
      </div>
    
    <?php } ?>
    </div>
  </div>


  <!-- Modal Caption (Image Text) -->
  </div>  
  <!-- The Close Button -->
  <span class="close">&times;</span>
</div>
