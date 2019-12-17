    <?php 
session_start();
include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
include_once __DIR__ . "/../CLASSES/LIKE/like.php";
include_once __DIR__ . "/../CLASSES/USER/user.php";
include_once __DIR__ . "/../UTILS/sessionHandler.php";

    $comment = new Comment();
    $user = new User();
    $like = new Like();
    $myComments = $comment->get_comment($_POST['objectID'], 'album');?>   
    <script src="JS/like.js"></script><?php
    if(empty($myComments)) {
      ?>
        <div class="comment">There is no comment yet</div>
      <?php
    }
    $myComments = array_reverse($myComments);
    $myComments = array_slice($myComments, 0, $_POST["commentNewCount"]);
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
          <button value="<?php echo $value['id']?>" onClick="edit_button_click('<?php echo "Alb".$value['objectID']?>', this, 'comment');" type="button" class="btn"><u>Edit</u> </button>
          <button onClick="deleteFunc(<?php echo "'Alb".$value['objectID']."'," . $value['id'];?>, 'comment');" type="button" class="btn"><u>Delete</u> </button>
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