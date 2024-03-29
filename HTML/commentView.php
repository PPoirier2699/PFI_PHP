<?php
//SERT A DISPLAY LES COMMENTAIRES, ON ARRIVES ICI GRACE AU JS imageView.js

session_start();
include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
include_once __DIR__ . "/../CLASSES/LIKE/like.php";
include_once __DIR__ . "/../CLASSES/USER/user.php";
include_once __DIR__ . "/../UTILS/sessionHandler.php";

$objectID = $_POST["objectID"];
$objectType = $_POST["objectType"];
$commentCount = $_POST["commentNewCount"];

    $comment = new Comment();
    $user = new User();
    $like = new Like();
    $myComments = $comment->get_comment($objectID, $objectType);
    ?><script src="JS/like.js"></script><?php
    if(empty($myComments)) {
      ?>
        <div class="comment">There is no comment yet</div>
      <?php
    }
    $myComments = array_reverse($myComments);
    $myComments = array_slice($myComments, 0, $commentCount);
    foreach($myComments as $key => $value){
    ?>
    <div class="comment">
      <div style="float: left;font-weight: bold;"><?php echo $user->get_user_by_id($value["authorID"])["username"];?></div>
      <div style="float: right;font-weight: bold;"><?php echo $value["creationTime"]?></div><br><br>

      <div class="commentText" style="overflow-wrap: break-word;">
        <?php echo $value["content"]?>
      </div>
      <div style="margin-left:5%;">
        <?php if(validate_session() && $value["authorID"] == $_SESSION["userID"]) {?>				      
          <button value="<?php echo $value['id']?>" onClick="edit_button_click('commentForJS', this, 'comment');" type="button" class="btn"><u>Edit</u> </button>
          <button onClick="deleteFunc('commentForJS', <?php echo $value['id']?>, 'comment');" type="button" class="btn"><u>Delete</u> </button>
        <?php } ?>

        <?php if(validate_session()) {?>
          <button onClick="checkLike('CMT'+<?php echo $value['id']?>, 'comment');" id="CMT<?php echo $value['id']?>"
          class="btn <?php if(!$like->already_liked($value['id'],'comment',$_SESSION['userID'])){echo "btn-outline-secondary";}else{echo "btn-primary";}?>">Like</button>
        <?php } ?>
      
      <small style="float:right;margin-right:5%;" id="<?php echo $value['id']?>"> <?php echo $like->get_likes($value['id'],'comment');?> Likes</small>
      </div>
    </div>
      
    <?php
    }    
    ?>
    <button class="btn" onClick="load_more_comment('commentForJS');" style="background-color:white;width:70%; margin:0 15%;">More Comment</button></div>
