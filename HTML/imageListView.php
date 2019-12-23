<script src="JS\imageView.js"></script>
<script src="JS\add.js"></script>
<script src="JS\delete.js"></script>
<script src="JS\edit.js"></script>
<script src="JS\comment.js"></script>
<script src="JS\like.js"></script>
<script src='JS\previewImage.js'></script>
<?php
		include_once __DIR__ . "/../CLASSES/IMAGE/image.php";
		include_once __DIR__ . "/../CLASSES/ALBUM/album.php";
		include_once __DIR__ . "/../CLASSES/LIKE/like.php";

		$albumID;
		if (isset($_GET["albumID"])) {
				$albumID = $_GET["albumID"];
		} else {
				header("Location: ../login.php?ErrorMSG=No albumID provided");
				die();
		}

		$img = new Image();
		$album = new Album();
		$like = new Like();


		$album = $album->get_album($albumID);
		//Set la variable de session avec les images de l'album courantes(que lutilisateur a clicke dessus ou autre)
		$img = $img->get_all_image_by_album($albumID);
		if(empty($img)){
			echo "<h2 class='display-4'>This album no longer exists</h2>";
		}
		else{
			?>
		<main role="main">
			<section class="jumbotron text-center">
				<div class="container">
					<h1><?php echo $album["title"];?></h1>
					<input id="currentAlbumID" value="<?php echo $album["id"];?>" type="text" style="display:none;">
				</div>
			</section>

	<div class="py-5 px-5 bg-light">
			<div class="row">

			<?php
				foreach($img as $key => $value){
						?>
						<div class="col-md-4">
					<div class="card mb-4 shadow-sm" >
					<img title="<?php echo $value["id"]?>" src="<?php echo $value["url"]?>" class="bd-placeholder-img card-img-top imageModal" style='height: 100%;' alt="<?php echo $value["description"]?>">
						<div class="card-body">
							<p class="card-text"><?php echo $value["description"]?></p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
								<?php if(validate_session() && $album["authorID"] == $_SESSION["userID"]) { ?>
									<button value="<?php echo $value['id']?>" onClick="edit_button_click('currentAlbumID', this, 'image');" type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
									<button value="<?php echo $value['id']?>" onClick="deleteFunc('commentForJS',<?php echo $value['id']?>, 'image');" type="button" class="btn btn-sm btn-outline-secondary">Delete</button>
								<?php }
								if(validate_session()) { ?>
									<button onClick="checkLike('IMG'+<?php echo $value['id']?>, 'image');"type="button" id="IMG<?php echo $value["id"]?>" 
									class="btn btn-sm <?php if(!$like->already_liked($value['id'],'image',$_SESSION['userID'])){echo "btn-outline-secondary";}else{echo "btn-primary";}?>">Like</button>
								<?php } ?>
								

								</div>
								<small id="<?php echo $value['id']?>"> <?php echo $like->get_likes($value['id'],'image');?> Likes</small>
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
					<div class="row" style="padding:2.5%; width:100%;position: relative;">
						<form class="row card-header" style="margin:0 2%; width:50%;" action="DOMAINLOGIC/addImage.dom.php" method="post" enctype="multipart/form-data">
							<input type="text" style="display:none;" name="albumID" value="<?php echo $albumID; ?>">
							<input type="text" style="display:none;" name="authorID" value="<?php echo $album["authorID"]; ?>">
							<input class="fileinput" type="file" name="addpicture" id="addpicture" onchange="readURL(this);">
							<label class="btn btn-primary" for="addpicture" style="margin-top: 5%; margin-left:30%; margin-right:30%; width: 100%;">Add image +</label>
							<textarea class="form-control mt-3" name="description" id="descaddimage" cols="30" rows="5" placeholder="Image description"></textarea>
							<button class="btn btn-primary" type="submit" style="margin-top: 5%; margin-left:30%; margin-right:30%; width:40%;">Submit</button>
						</form>
						<div   class="col" style="width:50%; padding:1%; margin:0 2%; position:relative;">
							<img style="position: absolute; top: 0; bottom: 0; margin: auto;" class="bd-placeholder-img card-img-top" id="imageView" src="IMG/addimage.png" alt='Image'>
						</div>
					</div>
					<?php
				}
				?>
				<?php 
			}
			?>

		
				
			 
		
	</div>

</main>
