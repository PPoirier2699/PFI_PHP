<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1>Album example</h1>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">

      <?php

        foreach($_SESSION["currentAlbum"] as $key => $value){
            $_SESSION["temp"] = $value;
            ?>
            <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="<?php echo $_SESSION["temp"]["url"]?>" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="an image of the album">
            <div class="card-body">
              <p class="card-text"><?php echo $_SESSION["temp"]["description"]?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted"><?php echo $_SESSION["temp"]["creationTime"]?></small>
              </div>
            </div>
          </div>
        </div>
            <?php
        }
        ?>
        
       
    </div>
  </div>

</main>