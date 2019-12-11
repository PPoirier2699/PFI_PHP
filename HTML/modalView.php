<!-- The Modal -->


<div id="myModal" class="modal ">
  <div class="modal-content">  

  <div>
      <!-- Modal Content (The Image) -->

      
    <img class="modal-image" id="img01">

    <div id="commentForJS" class="commentParent overflow-auto">
      
      <div class="comment">
        <div style="float: left;font-weight: bold;">Mon username</div>
        <div style="float: right;font-weight: bold;">14:54</div><br><br>

        <div class="commentText">
          Wow Quelle belle Photo
        </div>
      </div>
      <div class="comment">
        <div style="float: left;font-weight: bold;">Mon username</div>
        <div style="float: right;font-weight: bold;">15:12</div><br><br>

        <div class="commentText">
          J'adore trop
        </div>
      </div>
      <div class="comment">
        <div style="float: left;font-weight: bold;">Mon username</div>
        <div style="float: right;font-weight: bold;">16:39</div><br><br>

        <div class="commentText">
          J'aurais aimer y etre
        </div>
      </div>
      <div class="comment">
        <div style="float: left;font-weight: bold;">Mon username</div>
        <div style="float: right;font-weight: bold;">18:18</div><br><br>

        <div class="commentText">
          Matante guylaine t'aime fort
        </div>
      </div>
      <div class="comment">
        <div style="float: left;font-weight: bold;">Mon username</div>
        <div style="float: right;font-weight: bold;">18:24</div><br><br>

        <div class="commentText">
          quelle vue!
        </div>
      </div>
    
    <?php
    if(validate_session()) {?>
    </div>
    <div class="commentParent">
    <div class="comment">
          <div style="float: left;font-weight: bold;"><?php echo $_SESSION["userName"] ?></div>
          <textarea id="contentComment" name="content" class="form-control" rows="2"></textarea>
          <button class="btn btn-primary" type="submit" id="addCommentButton" style="font-size:12;margin-top:0;margin-bottom:0; margin-left:30%; margin-right:30%; width:40%;">Add Comment</button>
          <input type="text" name="objectType" id="objectType" value="image" style="display:none;">
          <input type="text" name="objectID" value="" id="imageIDPostComment" style="display:none;">
      </div>
    <?php } ?>
    </div>
  </div>


  <!-- Modal Caption (Image Text) -->
  </div>  
  <!-- The Close Button -->
  <span class="close">&times;</span>
</div>
