<?php
//SERT A DISPLAY LES COMMENTAIRES, ON ARRIVES ICI GRACE AU JS imageView.js

session_start();
include_once __DIR__ . "/../CLASSES/COMMENT/comment.php";
include_once __DIR__ . "/../CLASSES/USER/user.php";

$objectID = $_POST["objectID"];
$objectType = $_POST["objectType"];

if($objectType == "image") {
    $comment = new Comment();
    $user = new User();

    $myComments = $comment->get_comment_by_id($objectID);
    $myComments = array_reverse($myComments);
    foreach($myComments as $key => $value){
    ?>
    <div class="comment">
        <div style="float: left;font-weight: bold;"><?php echo $user->get_user($value["authorID"])["username"];?></div>
        <div style="float: right;font-weight: bold;"><?php echo $value["creationTime"]?></div><br><br>

        <div class="commentText" style="overflow-wrap: break-word;">
          <?php echo $value["content"]?>
        </div>
      </div>

    <?php
    }
}
?>