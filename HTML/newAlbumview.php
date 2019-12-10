<script src='JS/previewImage.js'></script>
<script src='JS/imageView.js'></script>

<?php
    if(isset($_GET['ErrorMSG'])){
        $error = $_GET['ErrorMSG'];  
        echo "<script>alert('$error');</script>";
    }
?>
<h3 style="text-align:center;">Create a new Album</h3><br>
<div class="row" style="padding:2.5%; width:100%;position: relative;">
    <form class="row card-header" style="margin:0 2%; width:50%;" action='DOMAINLOGIC/newAlbum.dom.php' method='post' enctype="multipart/form-data">
        <input class='form-control mb-2' placeholder='Title' name='title'>
        <textarea class='form-control z-depth-1' rows='4' placeholder='Album description' name='descriptionAlbum'></textarea><br>
        <input type="text" style="display:none;" name="authorID" value="<?php echo $_SESSION["userID"]; ?>">
        <input class="fileinput" type="file" name="firstImage" id="addpicture" onchange="readURL(this);"><br>
        <label class="btn btn-primary" style="margin: 5% 15%; width:70%;" for="addpicture">Add the first picture of the album</label>
        <textarea class='form-control z-depth-1' rows='4' placeholder='Image description' name='descriptionImage'></textarea><br>

        
        <button class="btn btn-primary" type="submit" style="margin-top: 5%; margin-left:30%; margin-right:30%; width:50%;">Submit</button>    
    </form>
    <div class="col" style="width:50%; padding:1%; margin:0 2%; position:relative;">
        <img style="position: absolute; top: 0; bottom: 0; margin: auto;" class="bd-placeholder-img card-img-top imageModal" id="imageView" src="IMG/preview.png" alt='Image'>
    </div>
</div>



