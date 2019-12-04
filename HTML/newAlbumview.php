<script src='JS/previewImage.js'></script>
<script src='JS/imageView.js'></script>

<?php
    if(isset($_GET['ErrorMSG'])){
        $error = $_GET['ErrorMSG'];  
        echo "<script>alert('$error');</script>";
    }
?>
<div class='form-group shadow-textarea p-4' style='margin: 90px 490px 0px -80px; display: inline-block; width: 50%;'>
<h3>Create a new Album</h3><br>
<form action='DOMAINLOGIC/newAlbum.dom.php' method='post' enctype="multipart/form-data">
    <input class='form-control mb-2' placeholder='Title' name='title'>
    <textarea class='form-control z-depth-1' rows='4' placeholder='Description' name='descriptionAlbum'></textarea><br>
    <input type="text" style="display:none;" name="authorID" value="<?php echo $_SESSION["userID"]; ?>">
    <input class="fileinput" type="file" name="firstImage" id="addpicture" onchange="readURL(this);"><br>
    <label class="btn btn-secondary" for="addpicture">Add the first picture of the album</label>
    <textarea class="form-control" name="descriptionImage" id="descaddimage" cols="30" rows="5" placeholder="Add Your Description Here..."></textarea><br>
    
    <button class="btn btn-primary btn-block" type="submit" >Submit</button>
    
</form>
<div class="border p-2" style='text-align: center; float: right; margin-top: -212px; margin-right: -200px; height: 15%; width: 35%;'>
    <p>Image preview</p>
    <img class="imageModal" id="imageView" src="#" alt='Image' style="display: none;">
</div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>


