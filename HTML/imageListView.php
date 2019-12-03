<script src="JS\imageView.js"></script>
<?php
    include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
    include_once __DIR__ . "/../CLASSES/ALBUM/album.php";

    $albumID;
    if (isset($_GET["albumID"])) {
        $albumID = $_GET["albumID"];
    } else {
        header("Location: ../login.php?ErrorMSG=No albumID provided");
        die();
    }

    $img = new Image();
    $album = new Album();

    $album = $album->get_album($albumID);
    //Set la variable de session avec les images de l'album courantes(que lutilisateur a clicke dessus ou autre)
    $img = $img->get_all_image_by_album($albumID);
    ?>

<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1><?php echo $album["title"];?></h1>
    </div>
  </section>

  <div class="py-5 bg-light">
      <div class="row">

      <?php

        foreach($img as $key => $value){
            ?>
            <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
          <img src="<?php echo $value["url"]?>" class="bd-placeholder-img card-img-top imageModal" width="100%" height="225" alt="<?php echo $value["description"]?>">
            <div class="card-body">
              <p class="card-text"><?php echo $value["description"]?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <?php
                if(validate_session() && $album["authorID"] == $_SESSION["userID"]) {
                ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                <?php } ?>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Like</button>
                </div>
                <small class="text-muted"><?php echo $value["creationTime"]?></small>
              </div>
            </div>
          </div>
        </div>
            <?php
        }
        ?></div><?php
        if(validate_session() && $album["authorID"] == $_SESSION["userID"]) {
          ?>          
          <form action="DOMAINLOGIC/addImage.dom.php" method="post" enctype="multipart/form-data">
            <input type="text" style="display:none;" name="albumID" value="<?php echo $albumID; ?>">
            <input type="text" style="display:none;" name="authorID" value="<?php echo $album["authorID"]; ?>">
            <input class="fileinput" type="file" name="addpicture" id="addpicture">
            <label class="btn btn-primary" for="addpicture">Add a picture to the album</label>
            <textarea class="form-control" name="description" id="descaddimage" cols="30" rows="5" placeholder="Add Your Description Here..."></textarea>
            <button class="btn btn-primary" type="submit" style="margin-top: 5%; margin-left:30%; margin-right:30%; width:40%;">Submit</button>
          </form>
          <?php
        }
        ?>
        
       
    
  </div>

</main>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>